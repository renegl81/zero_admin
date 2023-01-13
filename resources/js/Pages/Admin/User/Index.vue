<script setup>
import { ref, computed } from 'vue'
import { mdiBallot, mdiBallotOutline } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import SectionTitleBarSub from '@/components/SectionTitleBarSub.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
const titleStack = ref(['Admin', 'Users'])
const props = defineProps({
    users: Array,
    errors:Object,
    flash:Object
});

const fSearch = ref("");
const pageSize = ref(5);
const page = ref(1);
const total = ref(props.users.length)

const dataDisplay = computed(()=>{
    if (!props.users ||props.users.length === 0) return [];

    const filtered = props.users.filter(v=>{
        return v.name.includes(fSearch.value) || v.email.includes(fSearch.value);
    })
    total.value = filtered.length;
    return filtered.slice(pageSize.value * page.value - pageSize.value, pageSize.value * page.value)
})
const handleEdit = (index,row)=>{
    Inertia.visit(route('users.edit',[{'id':row.id}]));
}
const handleCurrentPageChange = val =>{
    page.value = val;
}
</script>

<template>
    <LayoutAuthenticated>
        <SectionTitleBar :title-stack="titleStack" />
        <SectionHeroBar>Users</SectionHeroBar>

        <SectionMain>
            <SectionTitleBarSub
                :icon="mdiBallotOutline"
                title="Users"
            />
            <CardBox
                :icon="mdiBallot"
            >

                <el-table :data="dataDisplay" stripe border size="medium" class="table-auto">
                    <el-table-column prop="name" sortable label="Name"/>
                    <el-table-column prop="email" sortable label="Email"/>
                    <el-table-column prop="status" label="Status"/>
                    <el-table-column prop="createdAt" sortable label="Created at"/>

                    <el-table-column fixed="right" label="Actions" width="260px">
                        <template #default="scope">
                            <Link :href="route('users.edit',[{'id': scope.row.id}])"><el-button>
                                Edit
                            </el-button></Link>
                        </template>
                    </el-table-column>
                </el-table>
                <el-pagination
                    background
                    @current-change="handleCurrentPageChange"
                    :page-size="pageSize"
                    :pager-count="page"
                    layout="total, prev,pager, next"
                    :total="total">
                </el-pagination>
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>
