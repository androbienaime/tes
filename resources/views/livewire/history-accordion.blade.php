<div>
    @props(['i' => 1])
    <x-custom-table class="striped-tables"
        :td_head="['NO', 'DATE', 'MONTANT', 'SOLDE', 'Type de transaction', 'ID Transaction', 'Action']">
        @foreach($history as $historical)
            <tr>
                <x-td-custom-table>{{ $i }}</x-td-custom-table>
                <x-td-custom-table>{{ $historical->created_at->format("d/m/Y")  }}</x-td-custom-table>
                <x-td-custom-table> {{ $historical->amount }}</x-td-custom-table>
                <x-td-custom-table >{{ $historical->solde }}</x-td-custom-table>
                <x-td-custom-table>{{ __($historical->type_of_transaction->name) }}</x-td-custom-table>
                <x-td-custom-table >{{ __($historical->code) }}</x-td-custom-table>
                <x-td-custom-table class="no-print">
                    <x-primary-button

                        x-on:click.prevent="$dispatch('open-modal', 'show-historical')"
                    >{{ __('Show') }}</x-primary-button>
                </x-td-custom-table>
            </tr>
            @php $i++; @endphp
        @endforeach
    </x-custom-table>

    <style>
        .striped-tables tr:nth-child(even) {
            background-color: #F2F2F2; /* Couleur de fond pour les lignes paires */
        }
    </style>
</div>
