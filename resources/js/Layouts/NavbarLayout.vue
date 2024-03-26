<template>
    <div class="NavbarLayout">
        <div class="w-64 min-h-full rounded-lg absolute p-2" :class="classePrimary">
            <div class="flex justify-center py-5">
                <Link :href="route('dashboard')">
                    <ApplicationLogo
                        class="block w-auto light:text-gray-800 fill-current h-9"
                    />
                </Link>
            </div>
            <div class="navbar-right">
                <ul class="py-4 navbar-list">
                    <li v-for="(item, index) in links" :key="index">
                        <NavLinkBlock
                            :href="route(item.linkHref)"
                            :active="route().current(item.linkActive)"
                            :iconName="item.icon"
                        >
                            {{item.text}}
                        </NavLinkBlock>
                    </li>
                </ul>
            </div>
            <!-- :href="route('logout')" method="post" as="button" -->
            <div class="footer-navbar bg-indigo-800">
                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                    <font-awesome-icon icon="fa-solid fa-right-from-bracket" class="mx-2 mr-5"/>
                    Log Out
                </ResponsiveNavLink>
            </div>
        </div>
    </div>
</template>
<script>
import { computed, defineComponent } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLinkBlock from '@/Components/NavLinkBlock.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
export default defineComponent({
    name:"NavbarLAyout",
    props:{
        dark:{
            type:Boolean
        }
    },
    components:{
        ApplicationLogo,
        NavLinkBlock,
        ResponsiveNavLink,
        Link,
    },
    setup(props){

        const classePrimary = computed(()=> props.dark ? "bg-gray-600" :"bg-slate-300")
        const links = [
            {
                linkHref:'dashboard',
                linkActive:'dashboard',
                icon:'fa-solid fa-chart-line',
                text:'Dashboard'
            },
            {
                linkHref:'condominia.index',
                linkActive:'condominia.index',
                icon:'fa-solid fa-city',
                text:'Condominio'
            },
            {
                linkHref:'invites.index',
                linkActive:'invites.index',
                icon:'fa-solid fa-envelope',
                text:'Convites'
            },
            {
                linkHref:'products.index',
                linkActive:'products.index',
                icon:'fa-solid fa-shop',
                text:'Produtos'
            },
            {
                linkHref:'users.index',
                linkActive:'users.index',
                icon:'fa-solid fa-address-card',
                text:'Usuários'
            },

        ]
        return{links,classePrimary}
    }
})
</script>
<style scoped>
.navbar-list,li, a{
    display:block;
    padding: 0.5rem 0rem;
}
.footer-navbar{
    padding: 12px;
    bottom: 0px;
    right: 0;
    left: 0;
    position: absolute;
    display: flex;
    justify-content: center;
    /* position: relative; */
}

</style>
