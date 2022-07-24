<template>
    <el-form>
        <el-row :gutter="20">
            <el-col :span="12">
                <!-- Photo -->
                <div
                    v-if="action !== 'register'"
                    class="flex items-center ml-16 mb-6 item"
                >
                    <label class="w-1/3 opacity-70">
                       Photo
                    </label>
                    <div class="flex w-full">
                        <div class="relative">
                            <img
                                :src="model.profile_photo_path === null ? '/images/rounded-logo.png' : `/storage/images/users/${model.profile_photo_path}`"  class="w-20 h-20 rounded-full"
                            />
                            <label class="
                                  absolute
                                  bottom-0
                                  flex
                                  items-center
                                  justify-center
                                  w-10
                                  h-10
                                  bg-white
                                  rounded-full
                                  cursor-pointer
                                  -right-4">
                                <img src="/images/icons/camera.svg"  alt="camera"/>
                                <input
                                    id="photo"
                                    type="file"
                                    class="hidden"
                                    @change="preview"
                                    autofocus
                                />
                            </label>
                        </div>
                    </div>
                </div>
                <el-form-item
                    label="Name"
                    :error="errors.name"
                >
                    <el-input v-model="formModel.name"></el-input>
                </el-form-item>
                <el-form-item
                    label="Email"
                    :error="errors.email"
                >
                    <el-input v-model="formModel.email"></el-input>
                </el-form-item>
                <el-form-item
                    v-if="action !== 'register' && action !== 'edit'"
                    label="Password"
                    :error="errors.password"
                >
                    <el-input v-model="formModel.password" show-password />
                </el-form-item>
                <el-form-item
                    v-if="action !== 'register' && action !== 'edit'"
                    label="Confirm"
                    :error="errors.confirm"
                >
                    <el-input v-model="formModel.password_confirmation" show-password />
                </el-form-item>
            </el-col>
            <el-col :span="12"> </el-col>
        </el-row>
        <el-row>
            <el-col>
                <el-form-item>
                    <Link
                        as="button"
                        type="button"
                        :href="route('users.index')"
                        class="
                                  mr-2
                                  bg-transparent
                                  hover:bg-gray-100
                                  text-black
                                  px-4
                                  border border-gray-400
                                  rounded"
                    >
                       Cancel</Link>
                    <el-button type="primary" @click="onSubmit">
                       <span v-if="action === 'edit'">
                          Edit
                       </span>
                        <span v-else>Create</span>
                    </el-button>
                </el-form-item>
            </el-col>
        </el-row>
    </el-form>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    model: Object,
    errors: Object,
    action: String,
})


        const formModel = ref(props.model);
        const previewUrl = ref("");

        const cardElement = ref("");


        onMounted(()=>{
            if(formModel.value.photo)
                previewUrl.value = route('home')+'/storage/user/'+formModel.value.profile_photo;
        })

       /* watch(
            () => [props.model, props.country],
            ([value, valueCountry]) => {
                formModel.value = value;
                previewUrl.value = route('home')+'/storage/'+formModel.value.photo;
            }
        );*/
        const preview = (e) => {
            const file = e.target.files[0];
            previewUrl.value = URL.createObjectURL(file);
            formModel.value.photo = file;
        };

        const onSubmit = async () => {
            return Inertia.post(props.url, formModel.value);
        };

</script>

<style scoped>
</style>
