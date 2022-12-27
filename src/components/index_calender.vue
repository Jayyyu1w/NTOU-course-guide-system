<script>
export default {
    data: function () {
        return {
            month: ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE",
                "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"],
            week: ["Sunday", "Monday", "Tuesday",
                "Wednesday", "Thursday", "Friday", "Saturday"],
            cal_color: ["#E67089", "#604A7B", "#E46C0A", "#FC92BA", "#77933C", "#31859C",
                "#00B0F0", "#0070C0", "#984807", "#953735", "#4A452A", "#3C3C3C"],
            weekdays: [],
            monthdays: [],
            e: new Date(),
            t: new Date().getFullYear(),
            n: new Date().getMonth() + 1,
            cal_width: 450,
            event_info: Array(32),
            blank_css: {
                ".blank": "",
            },
            header_css: {
                "width": ``,
                "height": ``,
                "background-color": ``,
            },
            default_css: {
                "width": ``,
                "height": ``,
                "line-height": ``,
                "color": ``,
            },
            today_content: {
                "position": "relative",
                "width": ``,
                "height": ``,
                "line-height": ``,
                "color": "#FFFFFF",
                "background-color": ``,
            },
            blank_content: {
                "width": ``,
                "height": ``,
                "background-color": "#E8E8E8",
            },
        }
    },
    methods: {
        checkDays: function (d) {
            let elem = new Date();
            if (this.t == elem.getFullYear() &&
                this.n == elem.getMonth() + 1 &&
                d == elem.getDate()) {
                return true;
            }
            return false;
        },
        wDay: function (e, t, n) {    //在一星期的第幾天
            return new Date(e, t - 1, n).getDay();
        },
        wDate: function (e, t) {      //取得月份天數
            return new Date(e, t, 0).getDate();
        },
        isToday: function (e) {
            return this.fullDate(new Date()) == this.fullDate(e);
        },
        fullDate: function (e) {
            return e.getFullYear() + "/" + (e.getMonth() + 1) + "/" + e.getDate();
        },
        genMonth: function () {
            let dateInfo = [];
            let w = this.week;
            let val = this.wDate(this.t, this.n) + 1;
            for (let r = 1; r < val; r++) {
                dateInfo.push({ day: r, weekday: w[this.wDay(this.t, this.n, r)] });
            }
            return dateInfo;
        },
        genWeek: function () {
            let res = [];
            for (let e = 0; e < 7; e++) {
                res[e] = this.week[e].substring(0, 3);
            }
            this.weekdays = res;
        },
        setStyle: function () {
            let sz = this.cal_width / 7;
            this.header_css["background-color"] = `${this.cal_color[this.n - 1]}`;
            this.header_css["width"] = `${this.cal_width}px`;
            this.header_css["height"] = `${sz}px`;
            this.default_css["width"] = `${sz}px`;
            this.default_css["height"] = `${sz}px`;
            this.default_css["line-height"] = `${sz}px`;
            this.default_css["color"] = `${this.cal_color[this.n - 1]}`;
            this.today_content["width"] = `${sz}px`;
            this.today_content["height"] = `${sz}px`;
            this.today_content["line-height"] = `${sz}px`;
            this.today_content["background-color"] = `${this.cal_color[this.n - 1]}`;
            this.blank_content["width"] = `${sz}px`;
            this.blank_content["height"] = `${sz}px`;
        },
        construct: function () {
            this.genWeek();
            let e = this.genMonth();
            let r = 0;
            let u = false;
            let res = [];
            while (!u) {
                if (this.week[r] == e[0].weekday) {
                    u = true;
                } else {    //補至該月起始星期
                    res.push(" ");
                    r++;
                }
            }
            for (let c = 0; c < 42 - r; c++) {
                if (c >= e.length) {    //剩下補空白
                    res.push(" ");
                } else {
                    let v = e[c].day;
                    res.push(v);
                }
            }
            this.monthdays = res;
            this.setStyle();
            console.log(this.monthdays);
            console.log(this.weekdays)
        },
        getMon: function () {
            this.construct();
            return this.month[this.n - 1];
        },
        nextMonth: function () {
            this.n++;
            if (this.n > 12) {
                this.n = 1;
                this.t++;
            }
            this.getEvent();
            this.construct();
        },
        prevMonth: function () {
            this.n--;
            if (this.n < 1) {
                this.n = 12;
                this.t--;
            }
            this.getEvent();
            this.construct();
        },
        getEvent: function (e) {
            console.log('hello!');
            let postD = { "year": this.t.toString(), "month": this.n.toString() };
            let postdata = JSON.stringify(postD);
            console.log(postdata);
            axios.post('https://database--project.000webhostapp.com/get_calendar.php', postdata).then((res) => {
                let ret = res.data;
                console.log(ret);
                this.event_info = [];
                for (let item of ret) {
                    let st = parseInt(item.startDate.slice(8));
                    let ed = parseInt(item.endDate.slice(8));
                    for (let i = st; i <= ed; i++) {
                        if (this.event_info[i] == undefined)
                            this.event_info[i] = [];
                        this.event_info[i].push({ "type": item.EventType, "event_name": item.Event });
                    }
                }
                console.log(this.event_info);
            });
        },
    },
    mounted: function () {
        this.getEvent();
        this.construct();
    },
}
</script>

<template>
    <div id="calendar">
        <div id="calendar_header" :style="header_css">
            <span class="icon-chevron-left" @click="prevMonth">
                &lt; </span>
            <h1>{{ month[n - 1] }}&nbsp;&nbsp;&nbsp;{{ t }}</h1>
            <span class="icon-chevron-right" @click="nextMonth"> > </span>
        </div>
        <div id="calendar_weekdays">
            <div v-for="wdays of weekdays" :style="default_css">{{ wdays }}</div>
        </div>
        <div id="calendar_content">
            <div v-for="eday of monthdays">
                <div v-if='eday == " "' :style="blank_content"></div>
                <div v-else-if="checkDays(eday)" :style="today_content" class="reldiv">
                    {{ eday }}
                    <template v-if="!isNaN(eday) && event_info[eday] != null">
                        <template v-for="ei of event_info[eday]">
                            <button v-if="ei.type == '假日'" type="button" class="btn eventbtn1" data-bs-toggle="tooltip"
                                data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                            <button v-if="ei.type == '課程'" type="button" class="btn eventbtn2"
                                data-bs-toggle="tooltip" data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                            <button v-if="ei.type == '生活'" type="button" class="btn eventbtn3"
                                data-bs-toggle="tooltip" data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                            <button v-if="ei.type == '考試'" type="button" class="btn eventbtn4" data-bs-toggle="tooltip"
                                data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                        </template>
                    </template>
                </div>
                <div v-else :style="default_css" class="reldiv">
                    {{ eday }}
                    <template v-if="!isNaN(eday)">
                        <template v-for="ei of event_info[eday]">
                            <button v-if="ei.type == '假日'" type="button" class="btn eventbtn1" data-bs-toggle="tooltip"
                                data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                            <button v-if="ei.type == '課程'" type="button" class="btn eventbtn2" data-bs-toggle="tooltip"
                                data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                            <button v-if="ei.type == '生活'" type="button" class="btn eventbtn3" data-bs-toggle="tooltip"
                                data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                            <button v-if="ei.type == '考試'" type="button" class="btn eventbtn4" data-bs-toggle="tooltip"
                                data-bs-placement="top" :title="ei.event_name">
                                &nbsp;
                            </button>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.eventbtn1 {
    position: absolute;
    background-color: #FF0000;
    border: none;
    border-radius: 50%;
    top: 50px;
    left: 5px;
    width: 10px;
    height: 10px;
    margin: 0px;
    padding: 0px;
}

.eventbtn2 {
    position: absolute;
    background-color: #0000FF;
    border: none;
    border-radius: 50%;
    top: 50px;
    left: 20px;
    width: 10px;
    height: 10px;
    margin: 0px;
    padding: 0px;
}

.eventbtn3 {
    position: absolute;
    background-color: #00FF00;
    border: none;
    border-radius: 50%;
    top: 50px;
    left: 35px;
    width: 10px;
    height: 10px;
    margin: 0px;
    padding: 0px;
}

.eventbtn4 {
    position: absolute;
    background-color: #FF00FF;
    border: none;
    border-radius: 50%;
    top: 50px;
    left: 50px;
    width: 10px;
    height: 10px;
    margin: 0px;
    padding: 0px;
}

.reldiv{
    position: relative;
}
</style>