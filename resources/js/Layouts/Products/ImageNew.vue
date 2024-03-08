<template>
<div class="AvatarNew">
    <div
        @mouseover="setUpload()"
        @mouseleave="hoverImage = false"
        class="avatar-control"
    >
    <img :src="imageURL" :class="{ 'avatar-control-h': hoverImage }" />
    <!-- <q-icon
        name="fa-solid fa-pen absolute"
        v-if="hoverImage"
        color="primary"
        @click.prevent="openFile()"
    /> -->
    <span @click.prevent="openFile()" class="absolute edit-avatar">
        <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" fill="#4855BB" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="1.5rem" height="1.5rem" viewBox="0 0 528.899 528.899" style="enable-background:new 0 0 528.899 528.899;"
        xml:space="preserve" >
            <path d="M328.883,89.125l107.59,107.589l-272.34,272.34L56.604,361.465L328.883,89.125z M518.113,63.177l-47.981-47.981
            c-18.543-18.543-48.653-18.543-67.259,0l-45.961,45.961l107.59,107.59l53.611-53.611
            C532.495,100.753,532.495,77.559,518.113,63.177z M0.3,512.69c-1.958,8.812,5.998,16.708,14.811,14.565l119.891-29.069
            L27.473,390.597L0.3,512.69z"/>
        </svg><br>
    </span>
    <input
        type="file"
        class="invisible"
        id="image"
        accept="image/*"
        ref="avatar"
        name="avatar"
        @change="getImage($event)"
    />
    </div>
</div>
</template>

<script>
import { defineComponent, ref } from "vue";
//   import { useUserStore } from "../../../stores/user";
//   import { storeToRefs } from "pinia";
//   import useLogin from "../../../composables/useLogin";
export default defineComponent({
    props:{imageURL:{type:String}},
    setup(props) {
        const hoverImage = ref(false);
        const setUpload = () => {
            hoverImage.value = true;
            console.log("ESTOU O SET", hoverImage.value);
        };
        const form = ref({ name: "", image:null });
        const setImage = ref(true);
    //   const useStore = useUserStore();
    //   const { data } = storeToRefs(useStore);
        const selectFile = ref({name:"", image:null});
        const avatar = ref(null);
    //   const { UploadAvatar } = useLogin();
        const openFile = () => {
            avatar.value.click();
        };
        const getImage = (e) => {
            let image = e.target.files[0];
            console.log(" .....", image);
            selectFile.value.image = image;
            form.value.name = selectFile.value.name;
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload(e) => {
                setImage.value = false;
            };
        };
        const upload = () => {
            let formData = new FormData();
            formData.append("imageOne", selectFile.value.image, selectFile.value.name);
            console.log(formData);
        };

        return {
            avatar,
            selectFile,
            setImage,
            form,
            hoverImage,
            openFile,
            getImage,
            upload,
            setUpload,
        };
    },
});
</script>

<style scoped>
/* Estilos específicos do componente aqui */
.invisible{
    display:none;
}
.absolute{
position: absolute;
}
.avatar-control {
cursor: pointer;
width: 2rem;
height: 2rem;
}
.rounded:hover {
opacity: 0.2;
}
.edit-avatar {
cursor: pointer;
margin-left: -57px;
margin-right: 47px;
opacity: 0;
}
.avatar-control-h {
opacity: 0.2;
}
.custom-file {
width: 70%;
height: 2rem;
}
.custom-file-label {
border: 1px solid #4855bb !important;
border-radius: 0.5rem !important;
}
</style>
