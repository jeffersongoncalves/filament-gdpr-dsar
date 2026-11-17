<?php

use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\Filament\GdprDsar\GdprDsarPlugin;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\DataSubjectRequestResource;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages\CreateDataSubjectRequest;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages\ListDataSubjectRequests;
use JeffersonGoncalves\Filament\GdprDsar\Resources\DataSubjectRequests\Pages\ViewDataSubjectRequest;
use JeffersonGoncalves\Filament\GdprDsar\Tests\Fixtures\TestUser;
use JeffersonGoncalves\GdprDsar\Enums\RequestStatus;
use JeffersonGoncalves\GdprDsar\Enums\RequestType;
use JeffersonGoncalves\GdprDsar\Facades\GdprDsar;
use JeffersonGoncalves\GdprDsar\Models\DataSubjectRequest;
use Livewire\Livewire;

beforeEach(function () {
    $this->admin = TestUser::create(['name' => 'Admin', 'email' => 'admin@example.com']);
    $this->subject = TestUser::create(['name' => 'Maria', 'email' => 'maria@example.com']);

    $this->actingAs($this->admin);
});

function verifiedRequest(RequestType $type): DataSubjectRequest
{
    return GdprDsar::verify(GdprDsar::open($type, test()->subject), test()->subject);
}

it('opens a request with the legal deadline', function () {
    $this->freezeSecond();

    Livewire::test(CreateDataSubjectRequest::class)
        ->fillForm(['type' => 'access', 'requester_name' => 'Maria', 'requester_email' => 'maria@example.com'])
        ->call('create')
        ->assertHasNoFormErrors();

    $request = DataSubjectRequest::sole();

    expect($request->type)->toBe(RequestType::Access)
        ->and($request->status)->toBe(RequestStatus::Pending)
        ->and($request->due_at->equalTo(now()->addMonth()))->toBeTrue();
});

it('lists requests and filters the overdue ones', function () {
    $overdue = GdprDsar::open(RequestType::Access);
    $this->travel(32)->days();
    $onTime = GdprDsar::open(RequestType::Erasure);

    Livewire::test(ListDataSubjectRequests::class)
        ->assertCanSeeTableRecords([$overdue, $onTime])
        ->filterTable('overdue')
        ->assertCanSeeTableRecords([$overdue])
        ->assertCanNotSeeTableRecords([$onTime]);

    expect(DataSubjectRequestResource::getNavigationBadge())->toBe('2')
        ->and(DataSubjectRequestResource::getNavigationBadgeColor())->toBe('danger');
});

it('verifies the requester and links the data subject', function () {
    $request = GdprDsar::open(RequestType::Access);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $request->getKey()])
        ->assertActionHidden('fulfil')
        ->callAction('verify', ['subject_type' => TestUser::class, 'subject_id' => $this->subject->getKey()])
        ->assertHasNoActionErrors();

    $request->refresh();

    expect($request->isVerified())->toBeTrue()
        ->and($request->subject?->is($this->subject))->toBeTrue();
});

it('does not verify against an unknown record', function () {
    $request = GdprDsar::open(RequestType::Access);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $request->getKey()])
        ->callAction('verify', ['subject_type' => TestUser::class, 'subject_id' => 999]);

    expect($request->fresh()->isVerified())->toBeFalse();
});

it('fulfils an access request and offers the export', function () {
    Storage::fake('local');
    $request = verifiedRequest(RequestType::Access);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $request->getKey()])
        ->callAction('fulfil')
        ->assertActionVisible('download')
        ->callAction('download')
        ->assertFileDownloaded("request-{$request->getKey()}.json");

    expect($request->fresh()->status)->toBe(RequestStatus::Completed);
    Storage::disk('local')->assertExists("gdpr/dsar/request-{$request->getKey()}.json");
});

it('erases the data subject on an erasure request', function () {
    $request = verifiedRequest(RequestType::Erasure);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $request->getKey()])
        ->callAction('fulfil');

    expect($this->subject->fresh()->name)->toBe('M****')
        ->and($request->fresh()->status)->toBe(RequestStatus::Completed);
});

it('completes manual rights with a response and rejects with a reason', function () {
    $manual = GdprDsar::open(RequestType::Rectification);
    $rejected = GdprDsar::open(RequestType::Access);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $manual->getKey()])
        ->assertActionHidden('fulfil')
        ->callAction('complete', ['response' => 'Address fixed.']);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $rejected->getKey()])
        ->callAction('reject', ['reason' => ''])
        ->assertHasActionErrors(['reason' => 'required']);

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $rejected->getKey()])
        ->callAction('reject', ['reason' => 'Identity not confirmed.']);

    expect($manual->fresh())->status->toBe(RequestStatus::Completed)->response->toBe('Address fixed.')
        ->and($rejected->fresh())->status->toBe(RequestStatus::Rejected)->response->toBe('Identity not confirmed.');

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $manual->getKey()])
        ->assertActionHidden('verify')
        ->assertActionHidden('complete')
        ->assertActionHidden('reject');
});

it('extends the deadline once by two months', function () {
    $this->freezeSecond();
    $request = GdprDsar::open(RequestType::Access);
    $due = $request->due_at->copy();

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $request->getKey()])
        ->callAction('extend', ['reason' => 'Records spread over several systems.']);

    expect($request->fresh()->due_at->equalTo($due->addMonths(2)))->toBeTrue();

    Livewire::test(ViewDataSubjectRequest::class, ['record' => $request->getKey()])
        ->assertActionHidden('extend');
});

it('offers the same actions on the table rows', function () {
    $request = GdprDsar::open(RequestType::Access);

    Livewire::test(ListDataSubjectRequests::class)
        ->assertTableActionHidden('fulfil', $request)
        ->callTableAction('reject', $request, ['reason' => 'Duplicate.']);

    expect($request->fresh()->status)->toBe(RequestStatus::Rejected);
});

it('registers the resource with the fluent plugin options', function () {
    $plugin = GdprDsarPlugin::get()->navigationGroup('GDPR')->slug('dsar')->subjectModels([TestUser::class]);

    expect(DataSubjectRequestResource::getNavigationGroup())->toBe('GDPR')
        ->and(DataSubjectRequestResource::getSlug())->toBe('dsar')
        ->and($plugin->getSubjectModels())->toBe([TestUser::class])
        ->and(__('filament-gdpr-dsar::filament-gdpr-dsar.resource.plural_label'))->toBe('Data subject requests');
});
