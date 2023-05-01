@hasrole('meter_reader')
    <p class="text-gray-400">You have been assigned the 'meter_reader' role.</p>
@else
    <p class="text-gray-400">You do NOT have the meter_reader role.</p>
@endhasrole

@can('publish')
    <p class="text-gray-400">You have permission to 'publish'.</p>
@else
    <p class="text-gray-400">Sorry, you may NOT publish.</p>
@endcan
