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
            class_name: "",
            star: 0
        }
    },
    created: function () {
        let getUrlString = location.href;
        let url = new URL(getUrlString);
        this.class_ID = url.searchParams.get('course_ID');
        this.class = url.searchParams.get('class');
        let links = "https://database--project.000webhostapp.com/get_information.php?course_ID=" + this.class_ID + "&class=" + this.class;
        let links2 = "https://database--project.000webhostapp.com/get_hot_avg.php?course_ID=" + this.class_ID + "&class=" + this.class;
        axios.get(links)
            .then((res) => {
                console.log(res);
                let info = res.data[0];
                this.text = info['information'];
                this.class_name = info['name'];
                this.hot=info['hot'];
                console.log(this.hot);
            })
        axios.get(links2)
        .then((res) => {
            var avg=res.data[0].avg;
            this.star=avg;
            console.log(avg);
        })
        
    },
    methods: {
        getAvg: function () {
            var avg=this.star/1;
            this.star=(avg*1).toFixed(2);
            return "star"+this.star;
        },
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
                    <div id="class_name" class="border_style info_text_style">
                        {{ class_name }}
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row-md-12">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="container border">
                                <div class="row h-100 pr-4 pt-3 mb-4">
                                    <div class="text-dark fw-bold cinfo">
                                        課程資訊
                                    </div>
                                </div>
                                <div id="md-editor" class="container">
                                    <md-editor language="zh-TW" v-model="text" preview-only="true"
                                        :toolbarsExclude="toolbarsExclude" maxLength=5000 />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                        <h4 class="fw-bolder" style="float:left;" v-bind:id="getAvg()">學生評價:&nbsp&nbsp{{this.star}}&nbsp&nbsp</h4>
                                        <div class="rating" style="float:left;">
                                            <div v-if="this.star>=5"><label for="5" class="display">☆</label></div>
                                            <div v-else><label for="5" class="no_display">☆</label></div>
                                            
                                            <div v-if="this.star>=4"><label for="4" class="display">☆</label></div>
                                            <div v-else><label for="4" class="no_display">☆</label></div>

                                            <div v-if="this.star>=3"><label for="3" class="display">☆</label></div>
                                            <div v-else><label for="3" class="no_display">☆</label></div>

                                            <div v-if="this.star>=2"><label for="2" class="display">☆</label></div>
                                            <div v-else><label for="2" class="no_display">☆</label></div>

                                            <div v-if="this.star>=1"><label for="1" class="display">☆</label></div>
                                            <div v-else><label for="1" class="no_display">☆</label></div>
                                        </div>
                                        <img style="width: 100px;"
                                            src="https://memeprod.ap-south-1.linodeobjects.com/user-template/8d0254d3eec4d41136f8604c25f60f56.png">
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

<style>
.cinfo {
    font-size: 36px;
    text-align: center;
}

.border_style {
    border-style: double;
    border-radius: 5px;
}

.info_text_style {
    font-size: 28px;
    font-weight: bold;
    padding: 10px 40px 10px 40px;
}

.rating {
    display: flex;
    margin-top: -10px;
    flex-direction: row-reverse;
    margin-left: -4px;
    float: left
}

.rating>div>label {
    position: relative;
    width: 19px;
    font-size: 25px;
    color: #ffdd00;
    cursor: pointer
}
.display::before {
    content: "\2605";
    position: absolute;
    opacity: 1;
}
.no_display::before {
    content: "\2605";
    position: absolute;
    opacity: 0;
}
</style>