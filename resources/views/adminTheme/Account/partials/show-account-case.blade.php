{{--
-- Templates d'affichages des carnets a echelon
--}}
@if($account)
    @php
        $transaction = \App\Models\Transaction::all();
    @endphp
    @if($account->type_of_account->active_case_payments  == true)

        <div class="mx-auto px-4 overflow-x-auto">
            <table  class="border-collapse border border-gray-400 w-full">
                @for($i = 1; $i <= 30 * $account->type_of_account->duration; $i++)
                    @if(($i - 1) % 10 == 0)
                        <tr>
                            @endif

                            <td id="bgColor-{{ $i }}" class="cursor-pointer border border-gray-400
                px-4 py-2 text-center
                     @foreach($account->tagspayment as $tag)
                            @if($i == $tag->tags)
                                bg-blue-600 text-white disabled
@endif
                            @endforeach

                                " > {{ $i }}<span class='text-[10px]'>
                        ({{ $i * $account->type_of_account->price  }})</span>

                                @foreach($account->tagspayment as $tag)
                                    @if($i == $tag->tags)
                                        @if(!$show_details)
                                            <span class="bi bi-check2-circle w-96 text-white"></span>
                                        @endif
                                        @if($show_details)
                                            <span class="text-[8px] text-white"> - {{ $transaction->find($tag->transaction_id)->employee->firstname }}</span>
                                            <br/><span class="text-[8px] text-white"> {{ Carbon\Carbon::parse($transaction->find($tag->transaction_id)->created_at)->format('Y-m-d') }}</span>
                                        @endif
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
