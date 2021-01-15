<template>
    <div class="columns is-mobile">
        <aside class="menu column is-one-quarter">
            <ul class="menu-list">
                <li>
                    <a href="#"
                        v-on:click.prevent="clickMenu('create_participant')"
                        v-bind:class="{ 'is-active' : activeMenu.create_participant }">
                            <i class="fas fa-plus is-size-7"></i> {{ textsMain.create_participant }}
                    </a>
                </li>
                <li><i class="fas fa-plus is-size-7"></i> {{ textsMain.create_category }}</li>
                <li>{{ textsMain.see_calendar }}</li>
                <li>{{ textsMain.see_calendar }}</li>
            </ul>
        </aside>
        <div class="column">
            <div class="columns columns-buttons my-0">
                <div class="column is-half-desktop is-two-fifths-table vcentered">
                    <button class="btn-primary">{{ textsMain.create_your_event }}</button>
                </div>
                <div class="column">
                    <div class="columns columns-buttons-rotated is-mobile">
                        <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated"><span v-html="textsMain.programmer"></span></div></button>
                        <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">{{ textsMain.category }}</div></button>
                        <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">{{ textsMain.event }}</div></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props: {
        texts_main_json: {
            type: String,
            require: true
        }
    },
    data() {
        return {
            activeMenu: {},
            textsMain: [],
        }
    },
    created(){
        this.activeMenu = this.$parent.activeMenu;
        this.textsMain = JSON.parse(this.texts_main_json);
    },
    methods: {
        clickMenu( name ){
            this.$emit('activeMenu', name);
        }
    }
}
</script>
