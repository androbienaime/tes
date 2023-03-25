<div>
    @php $error=0; $tagsPayment = json_encode(['']); @endphp
    <div x-data="tagSelect()" class="global">
    <x-center-form>
        <div class="grid gap-6 mb-2 md:grid-cols-2 border p-2">
            <!-- Name -->
            <div class="mb-6 ">
                <x-label-admin for="code" :value="__('Code Customer')" />
                <x-input-admin id="code" wire:model="query" class="block mt-1 w-full" type="text" name="code" required/>
                <x-input-error :messages="$error" class="mt-2 mx-auto" />
            </div>

            <!-- Name -->

            <div class="mb-6 ">
                <x-label-admin  for="name" :value="__('Full Name')" />
                <x-input-admin id="name" class="block mt-1 w-full {{ $classes }}" type="text" name="name" value="{{ $fullname }}"  required disabled="true"/>
            </div>
        </div>
        <div class="mb-1 ">
            <x-label-admin  for="name" :value="__('Current balance')" />
            <x-input-admin id="name" class="block mt-1 w-full bg-blue-400 text-white" type="text" name="name" value="{{ $current_balance }} HTG" required disabled="true"/>
        </div>

        <div class="mb-5">
            <x-input-label for="amount" :value="__('Amount')" />
            <div class="flex">
                  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    HTG
                  </span>
                <input type="text" id="website-admin" name="amount" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>
        @if($accountExist)
            @if($account->type_of_account->active_case_payments  == true)
            <div class="">
                <template x-for="tag in tags">
                    <input type="hidden" x-bind:name="inputName + '[]'" x-bind:value="tag">
                </template>
                <x-label-admin>{{ __("Number") }}</x-label-admin>
                <div class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded mb-3 leading-tight focus:outline-none focus:bg-white">
                    <div class="tags-input">
                        <template x-for="tag in tags" :key="tag">
                <span class="tags-input-tag">
                    <span x-text="tag"></span>
                    <button type="button" class="tags-input-remove" @click="tags = tags.filter(i => i !== tag)">
                        &times;
                    </button>
                </span>
                        </template>

                        <input class="tags-input-text" placeholder="Add tag..."
                               @keydown.enter.prevent="addTag(newTag)"
                               @keydown.space.prevent="addTag(newTag)"

                               x-model="newTag"
                               x-ref="tagsInput"
                        >
                    </div>
                    <x-input-error :messages="$errors->get('numberTag')" class="mt-2" />
                </div>
            </div>
            @endif
        @endif

        <x-primary-button :class="'mb-4'">{{ __("Save") }}</x-primary-button>
    </x-center-form>

    @if($accountExist)
        @if($account->type_of_account->active_case_payments  == true)

            @php echo "<script> var tgs = ". $tagsPayment = json_encode(['$account->tagspayment']) . "</script>" @endphp

            <div class="mx-auto px-4 overflow-x-auto">
                <table  class="border-collapse border border-gray-400 w-full">
                    @for($i = 1; $i <= 60; $i++)
                        @if(($i - 1) % 10 == 0)
                            <tr>
                        @endif

                <td @click="addTag('{{ $i }}')" class="cursor-pointer border border-gray-400
                px-4 py-2 text-center hover:bg-yellow-500 hover:text-white
                     @foreach($account->tagspayment as $tag)
                        @if($i == $tag->tags)
                            bg-blue-600 text-white disabled
                        @endif
                    @endforeach

                "> {{ $i }}<span class='text-[10px]'>
                        ({{ $i*$account->type_of_account->price  }})</span>

                    @foreach($account->tagspayment as $tag)
                        @if($i == $tag->tags)
                            <span class="bi bi-check2-circle w-96 text-white"></span>
                        @endif
                    @endforeach
                </td>

                                @if($i % 10 == 0)
                            </tr>
                        @endif
                    @endfor
                </table>
            </div>
        @endif
    @endif
    </div>
    <script type="text/javascript">
        let tgs = ['14', '6', '12'];
        function tagSelect() {
            return {
                tags: [],
                newTag: '',
                inputName: 'numberTag',
                addTag($tag){
                    if ($tag.trim() !== '' && $tag.match(/^([0-9-]+)$/)
                        && !this.tags.includes($tag)
                        && !tgs.includes($tag)) {
                        this.tags.push($tag.trim());
                        this.newTag = ''
                    }
                }
            }
        }

    </script>
    <style>
        .tags-input {
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            border-width: 1px;
            border-radius: .25rem;
            padding-left: .5rem;
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .25rem;
        }

        .tags-input-tag {
            display: inline-flex;
            line-height: 1;
            align-items: center;
            font-size: .875rem;
            background-color: #0080FF;
            color: #ffff;
            border-radius: .25rem;
            user-select: none;
            padding: .45rem;
            margin-right: .5rem;
            margin-bottom: .25rem;
        }

        .tags-input-tag:last-of-type {
            margin-right: 0;
        }

        .tags-input-remove {
            color: ghostwhite;
            font-size: 1.125rem;
            line-height: 1;
        }

        .tags-input-remove:first-child {
            margin-right: .25rem;
        }

        .tags-input-remove:last-child {
            margin-left: .25rem;
        }

        .tags-input-remove:focus {
            outline: 0;
        }

        .tags-input-text {
            flex: 1;
            outline: 0;
            padding-top: .25rem;
            padding-bottom: .25rem;
            margin-left: .5rem;
            margin-bottom: .25rem;
            min-width: 10rem;
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }
    </style>

</div>

