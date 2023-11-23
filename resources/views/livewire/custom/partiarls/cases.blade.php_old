@if($accountExist)
    @if($account->type_of_account->active_case_payments  == true)

        <div class="mx-auto px-4 overflow-x-auto">
            <table  class="border-collapse border border-gray-400 w-full">
                @for($i = 1; $i <= 30 * $account->type_of_account->duration; $i++)
                    @if(($i - 1) % 10 == 0)
                        <tr>
                            @endif

                            <td id="bgColor-{{ $i }}" @click="addTag('{{ $i }}')" class="cursor-pointer border border-gray-400
                px-4 py-2 text-center hover:bg-yellow-500 hover:text-white
                     @foreach($account->tagspayment as $tag)
                            @if($i == $tag->tags)
                                bg-blue-600 text-white disabled
                    @endif
                            @endforeach

                                " > {{ $i }}<span class='text-[10px]'>
                        ({{ $i * $account->type_of_account->price  }})</span>

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
