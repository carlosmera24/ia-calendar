<template>
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <h2>{{ text_admin_leaders }}</h2>
        <form class="form_manage_leader" action="">
            <div class="field">
                <div class="control has-icons-left">
                    <v-select v-model="participanIdSelect"
                        :options="participants"
                        :reduce="participant => participant.meta.id"
                        label="participant"
                    />
                    <div class="icon is-small is-left">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
//Import vue-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

export default {
    data() {
        return {
            isLoading: false,
            participanError: false,
            participants:[
                { participant: 'Carlos Mera',
                  meta: { id: 1, first_name: 'Carlos', last_name: 'Mera' }

                },
                {
                    participant: 'Ximena Mera',
                    meta: { id: 2, first_name: 'Ximena', last_name: 'Mera' },
                },
                {
                    participant: 'Lili Mera',
                    meta: { id: 3, first_name: 'Lili', last_name: 'Mera' }
                }
            ],
            participanIdSelect: null,
        }
    },
    props: [
        'text_admin_leaders'
    ]
}
</script>
