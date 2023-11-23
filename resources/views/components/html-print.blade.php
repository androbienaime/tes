<div
    x-data="{
		printDiv() {
			var printContents = this.$refs.container.innerHTML;
			var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	}"
    x-cloak
    x-ref="container"
    class="print:text-black relative page-number"
>

    <div class="print:hidden mt-6 flex justify-end">
        <x-primary-button x-on:click="printDiv()">
            {{ __('Print') }}
        </x-primary-button>
    </div>
    <div class="content">
        {{ $slot }}
    </div>

    <style>
        @page {
            size: A4; /* La taille de la page peut être ajustée en conséquence */
            counter-increment: page;
            content: "Page " counter(page);
        }

        .content::after {
            counter-increment: page;
            content: "Page " counter(page);
            position: absolute;
            bottom: 0;
            right: 0;
        }

        @media  print {
            .no-print{
                visibility:hidden;
            }
        }
    </style>
</div>
