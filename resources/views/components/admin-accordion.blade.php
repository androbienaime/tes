<div class="container mx-auto px-4 sm:px-8 max-w-screen-md text-gray-700">
    <section class="mb-12">
        <div x-data="dataPeople()" x-init="fetchPeople()">
            <input type="search" x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()" placeholder="Who are you looking for?" type="search" class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3 my-3" />
            <p x-show="search !== ''" class="my-2">
                You are looking for <span x-text="search" class="font-bold"></span>
            </p>
            <template x-for="(person, index) in searchPeople()" :key="index">
                <div class="md:flex mb-4 border-l-4 rounded cursor-pointer hover:bg-indigo-200 transition duration-300 ease-in-out" :class="{ 'border-4' : selected == index }" @click="selected !== index ? selected = index : selected = null">
                    <div class="mt-4 md:mt-0 p-4">
                        <div class="flex items-center">
                            <div class="mr-4">
                                <img class="rounded-lg" :src="person.picture.thumbnail" :alt="person.name.first + ' ' + person.name.last">
                            </div>
                            <h3 class="uppercase tracking-wide text-sm text-indigo-600 font-bold text-lg" x-text="person.name.first + ' ' + person.name.last"></h3>
                        </div>
                        <div x-show="selected == index" class="mt-4">
                            <div>
                                <span class="ml-2" x-text="person.email"></span>
                            </div>
                            <div class="text-gray-600">
                                <span class="ml-2" x-text="person.cell"></span>
                            </div>
                            <div class="text-gray-600">
                                <span class="ml-2" x-text="`${person.location.street.number}  ${person.location.street.name}`"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </section>
</div>

<script type="text/javascript">
    function dataPeople() {
        return {
            url: "/admin/api/account/history/1",
            people: [],
            selected: null,
            search: "",
            fetchPeople() {
                fetch(this.url) // ensure browsers don’t include credentials in the request
                    .then((response) => this.people = response)
                    .catch((err) => console.log(`error: ${err}`));
                    console.log(this.people);
            },
            searchPeople() {
                return this.people.filter((person) =>
                    `${person.name.first} ${person.name.last}`
                        .toLowerCase()
                        .includes(this.search.toLowerCase())
                );
            }
        };
    }

</script>
