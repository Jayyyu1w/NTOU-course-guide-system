<script>
import MdEditor from 'md-editor-v3'
import 'md-editor-v3/lib/style.css'
import '@vavt/md-editor-extension/dist/previewTheme/arknights.css';
import ZH_TW from '@vavt/md-editor-extension/dist/locale/zh-TW';

MdEditor.config({
    editorConfig: {
        languageUserDefined: {
            'zh-TW': ZH_TW,
        },
    },
});
export default {
    name: 'App',
    components: {
        MdEditor
    },
    data: function () {
        return {
            text: '',
            class_ID: "",
            class: "",
        }
    },
    created: function () {
        let getUrlString = location.href;
        let url = new URL(getUrlString);
        this.class_ID = url.searchParams.get('course_ID');
        this.class = url.searchParams.get('class');
        axios.get(`https://database--project.000webhostapp.com/get_course_md.php?course_ID=${this.class_ID}&class=${this.class}`)
            .then((res) => {
                this.text = res.data;
                console.log(this.text);
            })
    },
    methods: {

    },
    mounted: function () {

    },
}
</script>

<template>
    <section id="class_info">
        <div class="container d-flex justify-content-center my-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="class_name" class="border_style px-5 py-1">
                        <h2>class</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="col">
                <div class="row-md-12">
                    <div class="col-md-12 offset-md-1">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="container border">
                                    <div class="row h-100 pr-4 pt-3 mb-4">
                                        <div class="text-dark fw-bold fs-3">
                                            課程資訊
                                        </div>
                                    </div>
                                    <div id="md-editor" class="container">
                                        <md-editor language="zh-TW" v-model="text" preview-only="true"
                                            :toolbarsExclude="toolbarsExclude" maxLength=5000 />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="container border">
                                    <div class="pr-4 pt-3 mb-4">
                                        <div class="text-dark fw-bold fs-4">
                                            你會對這堂課感興趣嗎?
                                        </div>
                                    </div>
                                    <div class="pr-4 mb-4">
                                        <div class="text-dark fw-bold fs-4">
                                            與該課程相似:
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="pr-4 pt-3 mb-4">
                                        <div class="text-dark fw-bold fs-4">
                                            學生評價:
                                            <img style="width: 50px;"
                                                src="https://memeprod.ap-south-1.linodeobjects.com/user-template/8d0254d3eec4d41136f8604c25f60f56.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>