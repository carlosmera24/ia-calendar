<template>
    <div class="columns is-mobile">
        <aside class="menu column is-one-quarter">
            <ul class="menu-list">
                <li>
                    <a href="#"
                        v-on:click.prevent="clickMenu('create_participant')"
                        v-bind:class="{ 'is-active' : activeMenu.create_participant }">
                            <i class="fas fa-plus is-size-7"></i> {{ text_create_participant }}
                    </a>
                </li>
                <li><i class="fas fa-plus is-size-7"></i> {{ text_create_category }}</li>
                <li>{{ text_see_calendar }}</li>
                <li>{{ text_anual_fiscal }}</li>
            </ul>
        </aside>
        <div class="column">
            <div class="columns columns-buttons my-0">
                <div class="column is-half-desktop is-two-fifths-table vcentered">
                    <button class="btn-primary">{{ text_create_your_event }}</button>
                </div>
                <div class="column">
                    <div class="columns columns-buttons-rotated is-mobile">
                        <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated"><span v-html="text_programmer"></span></div></button>
                        <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">{{ text_category }}</div></button>
                        <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">{{ text_event }}</div></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props: [
        'text_create_participant',
        'text_create_category',
        'text_see_calendar',
        'text_anual_fiscal',
        'text_create_your_event',
        'text_programmer',
        'text_category',
        'text_event'
    ],
    data() {
        return {
            activeMenu: {},
        }
    },
    created(){
        this.activeMenu = this.$parent.activeMenu;
    },
    methods: {
        clickMenu( name ){
            this.$emit('activeMenu', name);
        }
    }
}
</script>
