
<div x-data="{tags: [], newTag: '', inputName: 'numberTag' }" class="">
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
                   @keydown.enter.prevent="if (newTag.trim() !== '' && newTag.match(/^([0-9-]+)$/)) tags.push(newTag.trim()); newTag = ''"
                   @keydown.space.prevent="if (newTag.trim() !== '' && newTag.match(/^([0-9-]+)$/)) tags.push(newTag.trim()); newTag = ''"

                   x-model="newTag"
            >
        </div>
        <x-input-error :messages="$errors->get('numberTag')" class="mt-2" />
    </div>
</div>

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
