<template>
    <div>
        <div class="mt-8 relative flex items-center border border-gray-200 rounded-sm">
            <label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Thumbnail Image</label>
            <input
                @input="
                    thumbnail = $event.target.files[0];
                    $emit('update:thumbnail', $event.target.files[0])
                "
                @change="thumbnailPreview($event.target.files[0])"
                type="file"
                class="pt-6 relative max-w-lg block w-full h-20 font-semibold px-4 sm:max-w-full sm:text-base required text-gray-500 focus:outline-none"
            />
            <img v-if="thumbnailLink!=''" class="h-32 w-40 m-3 p-3" :src="thumbnailLink" alt="Thumbnail" />
        </div>
        <label v-if="thumbnail_error" class="font-medium flex justify-center items-center text-red-600 ml-3 bg-gray-50 p-4">{{thumbnail_error}}</label>
        <!-- More -->
        <div v-if="imagesLink.length" class="relative grid grid-cols-4 gap-3 items-center border border-gray-200 rounded-sm p-4">
            <div v-for="(link, index) in imagesLink" :key="index" class="relative group">
                <img class="h-32 w-40 mx-auto" :src="link" alt="image" />
                <div @click="deleteImage(link)" class="absolute p-3 inset-0 bg-gray-700 opacity-60 hidden group-hover:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex justify-center items-center mx-auto mt-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="mt-8 relative">
            <label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Add more images</label>
            <input id="file-upload" @input="setImages($event.target.files[0])" name="file-upload" type="file" class="pt-6 relative max-w-lg block w-full h-20 font-semibold px-4 sm:max-w-full sm:text-base border border-gray-200 rounded-sm required text-gray-500 focus:outline-none" />
        </div>
        <label v-if="images_error" class="font-medium flex justify-center items-center text-red-600 ml-3 bg-gray-50 p-4">{{images_error}}</label>
    </div>
</template>
<script>
import {ref} from "vue"

export default {
    props: ["thumbnail", "images",'thumbnail_error','images_error','thumbnail_link','images_link'],
    setup(props,context) {
        const thumbnailLink = ref(props.thumbnail_link)
        const imagesLink = ref(props.images_link)
        const images = ref(props.images)

        function thumbnailPreview(file) {
            const reader = new FileReader()
            reader.onload = (e) => {
                thumbnailLink.value = e.target.result
            }
            reader.readAsDataURL(file)
        }

        function isValid(file) {
            const types = ["jpeg", "jpg", "png"]
            let ext = file.name.split(".")[file.name.split(".").length - 1]
            return types.includes(ext)
        }

        function setImages(file) {
            if (isValid(file)) {
                images.value.push(file)
                const reader = new FileReader()
                reader.onload = (e) => {
                    imagesLink.value.push(e.target.result)
                }
                reader.readAsDataURL(file)
            }
        }
        function deleteImage(url) {
            let type=url.slice(0,4)
            const link = imagesLink.value.indexOf(url);
            if(type==='data'){
                let newArr=imagesLink.value.filter((image)=>image.slice(0,4)==='data')
                if(newArr){
                    images.value.splice(newArr.indexOf(url), 1)
                }
                imagesLink.value.splice(link, 1)
            }else{
                imagesLink.value.splice(link, 1)
                context.emit('deleted_url',url)
            }
        }

        return {
            thumbnailLink,
            imagesLink,
            setImages,
            deleteImage,
            thumbnailPreview,
        }
    },
}
</script>
