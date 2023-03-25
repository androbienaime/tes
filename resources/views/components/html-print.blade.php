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
    class="print:text-black relative"
>
    {{ $slot }}

    <div class="print:hidden mt-6 flex justify-end">
        <x-primary-button x-on:click="printDiv()">
            {{ __('Print') }}
        </x-primary-button>
    </div>



</div>
