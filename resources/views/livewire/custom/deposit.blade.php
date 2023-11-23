<div>
    @php $error=0; $tagsPayment = json_encode(['']);@endphp
    <div x-data="tagSelect()" class="global">
    <x-center-form>
        <form method="post" action="{{ route("admin.deposit.store") }}">
            @csrf
        <div class="grid gap-6 mb-2 md:grid-cols-2 border p-2">
            <!-- Name -->
            <div class="">
                <x-label-admin :required="true" for="code">{{ __("Code Customer") }}</x-label-admin>
                <x-input-admin id="code" wire:model="query" class="block mt-1 w-full" type="text" name="code" required/>
                <x-input-error :messages="$error" class="mt-2 mx-auto" />
            </div>

            <!-- Name -->

            <div class="">
                <x-label-admin for="name" :value="__('Full Name')" />
                <x-input-admin id="name" class="block mt-1 w-full {{ $classes }}" type="text" name="name" value="{{ $fullname }}"  required disabled="true"/>
                @if(!$account_state)
                    <x-input-error :messages="' Ce compte a ete desactiver'" class="mt-2 mx-auto" />
                @endif
            </div>
        </div>
        <div class="mb-1 ">
            <x-label-admin  for="name" :value="__('Current balance')" />
            <x-input-admin style="background-color:blue" id="current_balance" class="block mt-1 w-full bg-blue-600 text-white" type="text" name="name" value="{{ $current_balance }} HTG" required disabled="true" :style="'background-color:#00416d;'"/>
        </div>

        <div class="mb-5">
            <x-label-admin required="true" for="amount" :value="__('Amount')" />
            <div class="flex">
                  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    HTG
                  </span>
                <input x-model="amount" x-on:blur="amountWaiting()" :value="amountCheck" type="text" name="amount" class="rounded-none  bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                @if($accountExist)
                    @if($account->type_of_account->active_case_payments  == true)
                    <button @click.prevent="generateTag()" class="right-0 inline-flex items-center px-3 text-sm text-white bg-blue-500 border border-l-0 border-blue-300 rounded-r-md dark:bg-blue-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="bi bi-gear" id="generate"></i>
                         &nbsp;Generer
                      </button>
                    @endif
                @endif
            </div>
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            <span class="text-blue-600" x-show="showStay">
                En attente : <span x-text="wait"></span> HTG
                <input type="checkbox" name="" />
            </span>
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
                    <button type="button" class="tags-input-remove" @click="removeTag(tag)">
                        &times;
                    </button>
                </span>
                        </template>

                        <input class="tags-input-text" placeholder="Ajouter des Casiers"
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

        <x-primary-button :class="'flex'" :id="'btn'" :style="'background-color:#00416d ;hover:yellow;'">{{ __("Save") }}</x-primary-button>

            @if($accountExist)
            @if($account->type_of_account->active_case_payments  == true)
                <x-primary-button :class="'block bg-red-100'" :style="'background-color:red'" @click.prevent="resetTag()" x-show="reset">{{ __("Reset") }}</x-primary-button>
            @endif
        @endif
        </form>
        <div class="mb-4"></div>

    </x-center-form>

    <div class="sm:w-full md:w-full max-w-7xl mx-auto">
         @include("livewire.custom.partiarls.cases")
    </div>

    <script type="text/javascript">
        let tgs = ['']; let echelon =0, duration=0, resetTg = false;

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.on('codeFound', () => {
                const ta = @this.tagspayment;
                if(ta != null){
                    var obj = JSON.parse(ta);

                    for(var i=0; i < obj.length; i++){
                        tgs[i] = obj[i].tags.toString();
                    }

                }

                if(@this.echelon != null){
                    resetTg = true;
                    echelon = JSON.parse(@this.echelon);
                    duration = JSON.parse(@this.duration);
                }
            }) }
        ) ;


        function tagSelect() {
            return {
                tags: [],
                newTag: '',
                inputName: 'numberTag',
                amount: '',
                amountCheck: '',
                totalAmount: 0,
                wait : '',
                bgColor : ' ',
                reset : false,
                showStay : false,
                addTag($tag){
                    if ($tag.trim() !== '' && $tag.match(/^([0-9-]+)$/)
                        && !this.tags.includes($tag)
                        && !tgs.includes($tag)) {

                            if(!$tag.includes('-') && $tag <= duration*30) {
                                this.tags.push($tag.trim());
                                this.newTag = ''
                                this.amountTotal();
                                this.changeColor($tag);
                            }else{
                                $tg1 = $tag.split('-')[0];
                                $tg2 = $tag.split('-')[1];
                                if(parseInt($tg1) < parseInt($tg2)){
                                    for(var i= parseInt($tg1); i <= parseInt($tg2); i++){
                                        if(!this.tags.includes(i.toString().trim())
                                            && !tgs.includes(i.toString().trim()) && i <= duration*30){
                                            this.tags.push(i.toString().trim());
                                            this.newTag = ''
                                            this.amountTotal();
                                            this.changeColor(i);
                                        }
                                    }
                                }
                            }
                    }
                    this.showReset();
                },
                removeTag($tag){
                    this.tags = this.tags.filter(i => i !== $tag);
                    this.amountTotal();
                    this.changeColor($tag);
                    this.showReset();
                },
                resetTag(){
                    for(var i=0; i < this.tags.length; i++){
                        this.changeColor(parseInt(this.tags[i]), true);
                    }
                    this.tags = [];
                    this.amountTotal();
                    this.showReset();
                },
                showReset(){
                    this.reset = false;
                    if(this.tags.length > 0){
                        this.reset = true;
                    }
                },
                changeColor($tag, ext = false){
                    var exist = false;
                    var element = document.getElementById("bgColor-" + $tag);
                    for(var i=0; i < this.tags.length; i++){
                        if($tag == this.tags[i]){
                            element.style.backgroundColor="#e69b00";
                            element.style.color = "white";
                            exist = true;
                        }
                    }

                    if(exist == false || ext==true){
                        element.style.backgroundColor = "transparent";
                        element.style.color = "black";

                    }
                },
                generateTag() {
                    let exclusions = [];
                    exclusions.push(0);
                    for(var i=0; i < tgs.length; i++){
                        exclusions.push(tgs[i] * echelon);
                    }

                    function somme_proche(somme_max) {
                        // La liste
                        let liste_nombres = Array.from({ length: duration*30 + 1 }, (_, i) => i * echelon).filter(num => !exclusions.includes(num));;

                        // Tri de la liste dans l'ordre décroissant
                        liste_nombres.sort((a, b) => b - a);

                        // Initialisation du tableau de sommes possibles
                        let sommes = Array(somme_max + 1).fill(-1);
                        sommes[0] = 0;

                        // Parcours des éléments de la liste
                        for (let n of liste_nombres) {
                            // Parcours des sommes possibles en ordre décroissant
                            for (let i = somme_max; i >= 0; i--) {
                                // Si la somme i est possible avec les éléments précédents, on peut ajouter n
                                if (sommes[i] >= 0) {
                                    // Calcul de la nouvelle somme possible
                                    let nouvelle_somme = sommes[i] + n;
                                    // Si cette somme est plus petite que somme_max et est plus grande que la somme actuelle pour cette valeur i,
                                    // on met à jour la somme pour i+n
                                    if (nouvelle_somme <= somme_max && sommes[i + n] < 0) {
                                        sommes[i + n] = nouvelle_somme;
                                    }
                                }
                            }
                        }

                        // Recherche de la somme la plus proche de la valeur cible
                        let proche_somme = somme_max;
                        for (let i = somme_max; i >= 0; i--) {
                            if (sommes[i] >= 0) {
                                proche_somme = i;
                                break;
                            }
                        }

                        // Recherche de la sous-liste qui correspond à la somme la plus proche de la valeur cible
                        let resultat = [];
                        for (let n of liste_nombres) {
                            if (proche_somme - n >= 0 && sommes[proche_somme - n] == sommes[proche_somme] - n) {
                                resultat.push(n);
                                proche_somme -= n;
                            }
                        }

                        // Tri de la liste résultat dans l'ordre décroissant
                        resultat.sort((a, b) => b - a);

                        // Si la valeur cible est dans la liste d'origine, on la rajoute à la liste résultat
                        if (liste_nombres.includes(somme_max)) {
                            resultat = [somme_max];
                        }

                        // Calcul de la somme des nombres dans la nouvelle liste
                        let somme_liste = resultat.reduce((a, b) => a + b, 0);

                        // Retourne la liste résultat et la somme des nombres dans la nouvelle liste
                        return [resultat, somme_liste];
                    }

                    // Demande à l'utilisateur d'entrer un nombre
                    let somme_max = parseInt(this.amount);

                    // Cherche la liste resultatat
                    for(var i=0; i < somme_proche(somme_max)[0].length; i++){
                        this.addTag((somme_proche(somme_max)[0][i] / echelon).toString());
                    }

                    this.amountWaiting();
                },
                amountTotal(){
                    this.totalAmount =0;
                    for(var i=0; i < this.tags.length; i++){
                        var total =0;
                        this.totalAmount  += parseInt(this.tags[i]) * echelon;
                    }

                    this.amountCheck = this.totalAmount.toString();
                },
                amountWaiting(){
                    amountWaiting =0;
                    this.wait = "";
                    for(var i=0; i < this.tags.length; i++){
                        amountWaiting  += parseInt(this.tags[i]) * echelon;
                    }


                    // this.wait = (this.amount - this.amountCheck).toString();
                    // this.wait += (this.amount - amountWaiting).toString();
                    // this.showStay = true;
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

        #btn{
            hover:#277ec3;
        }
    </style>

</div>

