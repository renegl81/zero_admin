<script setup>
import { ref, computed } from 'vue'
import { mdiBallot, mdiBallotOutline } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import SectionTitleBarSub from '@/components/SectionTitleBarSub.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import UserForm from "./UserForm.vue";
const titleStack = ref(['Admin', 'Users'])

const props = defineProps({
    user:Object,
    sectorOptions:Array,
    typeOptions:Array,
    errors:Object,
    country:Object,
    pk:String,
    intent:String
});

</script>

<template>
    <LayoutAuthenticated>
        <SectionTitleBar :title-stack="titleStack" />
        <SectionHeroBar>Users</SectionHeroBar>

        <SectionMain>
            <SectionTitleBarSub
                :icon="mdiBallotOutline"
                title="User edit"
            />
            <CardBox
                :icon="mdiBallot"
            >
              <UserForm
                :model="user"
                :action="'edit'"
                :errors="errors"
                :url="route('users.update',{id:user.id})"
                ></UserForm>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
