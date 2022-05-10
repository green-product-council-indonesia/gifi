@section('title', 'Dashboard')
<div>
    @hasanyrole('admin|super-admin')
        @livewire('dashboard.admin')
    @endhasanyrole
    @hasrole('client')
        @livewire('dashboard.client')
    @endhasrole
    @hasrole('verifikator')
        @livewire('dashboard.verifikator')
    @endhasrole
    @hasrole('visitor')
        @livewire('dashboard.visitor')
    @endhasrole
</div>
