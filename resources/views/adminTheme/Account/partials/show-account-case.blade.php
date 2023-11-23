{{--
-- Templates d'affichages des carnets a echelon
--}}
@props(["show_details" => false])
@if($account)
    @if($account->type_of_account->active_case_payments  == true)
        <div class="flex flex-col sm:flex-row">
        @for($j=0; $j < (30 * $account->type_of_account->duration)/30; $j++)
                <div class="w-full md:w-1/2 m-2 overflow-x-auto">
                        <table  class="min-w-full border-collapse border border-gray-400">
                            @for($i = 30 * $j+1; $i <= 30 * ($j + 1); $i++)
                                @if(($i - 1) % 5 == 0)
                                    <tr>
                                        @endif

                                        <td id="bgColor-{{ $i }}" class="text-[10px] cursor-pointer border border-gray-400
                            px-4 py-2 text-center
                                 @foreach($account->tagspayment as $tag)
                                        @if($i == $tag->tags)
                                            bg-blue-600 text-white disabled
            @endif
                                        @endforeach

                                            " > {{ $i }}<span class='text-[8px]'>
                                    ({{ $i * $account->type_of_account->price  }})</span>

                                            @foreach($account->tagspayment as $tag)
                                                @if($i == $tag->tags)
                                                    @if(!$show_details)
                                                        <span class="bi bi-check2-circle w-96 text-white"></span>
                                                    @endif
                                                    @if($show_details)
                                                        <p class="text-[8px] text-white">{{ $transaction->find($tag->transaction_id)->employee->firstname }}</p>
                                                        <p class="text-[8px] text-white"> {{ Carbon\Carbon::parse($transaction->find($tag->transaction_id)->created_at)->format('Y-m-d') }}</p>
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
                @endfor
            </div>
    @endif
@endif
