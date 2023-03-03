<x-admin-layout>

  <x-slot name="header">
    <div class="flex flex-row">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Branch') }}
      </h2>

    <!-- Right position -->
    <div class="absolute origin-top-right right-5">
      <x-btn-header-admin href="route('dashboard')">{{ __("Add Branch") }}</x-btn-header-admin>
    </div>
      </div>
  </x-slot>

    <x-breadcrumb />

    <x-flashmessage :status="session('status')" />
  <!-- Panel -->

    <x-primary-panel :cs="'bi bi-git'" :title="__('Add a Branch')">
      <div class="flex mx-auto w-1/2 p-5 items-center">
        <form method="POST" action="{{ route("admin.branch.store") }}">
            @csrf

            <!-- Name -->
            <div class="mb-6 ">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" placeholder="Centrale LesTruviens B.G " type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2 border p-2">

                <div>
                  <x-label-admin for="state" >{{ __("Department") }}</x-label-admin>
                  <x-select-admin id="state2" type="text" name="state" required>
                      <option value="">{{ __("Select State") }}</option>
                      @foreach($states as $state)
                          <option value="{{ $state->id}}">{{ $state->name}}</option>
                      @endforeach
                  </x-select-admin>
                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>

                <div>
                  <x-label-admin for="city">{{ __("City") }}</x-label-admin>
                  <x-select-admin id="city2" type="text" name="city" required>
                      <option value="">{{ __("Select City") }}</option>
                  </x-select-admin>
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div>
                    <x-label-admin for="address">{{ __("Address") }}</x-label-admin>
                    <x-input-admin type="text" name="address1" placeholder="#76, Rue poudriere, Trou-du-Nord" required></x-input-admin>
                    <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                </div>

                <div>
                    <x-label-admin for="phone">{{ __("Phone") }}</x-label-admin>
                    <x-input-admin type="text" name="phone" placeholder="+509 33356231"></x-input-admin>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>
            <x-primary-button>{{ __("Save") }}</x-primary-button>
        </form>
    </div>
    </x-primary-panel>
  <div class="">
    <div class="max-w-7xl sm:px-6 ">
        <div class="bg-white overflow-hidden shadow-sm ">
            <div class="p-6 text-gray-900">
                <livewire:branch-table />
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#state2").change(function (event){
                var id_state = this.value;
                $("#city2").html('');

                $.ajax({
                    url: '/api/fetch-city',
                    type: 'POST',
                    dataType: 'json',
                    data: {state_id : id_state,_token: "{{ csrf_token() }}"},
                    success:function (response){
                        $("#city2").html("<option value=''>{{ __("Select City") }}</option>");
                        $.each(response.cities, function (index, val){
                            $("#city2").append("<option value='"+val.name+"'>"+val.name+"</option>");
                        });
                    }
                });
            });


        });

    </script>
</x-admin-layout>
