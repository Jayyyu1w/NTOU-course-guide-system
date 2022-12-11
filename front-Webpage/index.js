$(window).scroll(function () {
    if ($(window).scrollTop() <= 230) {
        $(".navbar").removeClass("fixed-top");
    } else {
        $(".navbar").addClass("fixed-top");
    }
});

Vue.createApp({
    data: function () {
        return {
            inform: [],
        }
    },
    methods: {

    },
    mounted: function () {
        axios.get("http://localhost:3000/notify") //發出http請求
            .then((res) => {
                console.log(res);
                this.inform = res.data;
            })
    },
}).mount('#notification');

Vue.createApp({
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
            cal_width: 480,
            blank_css: {
                ".blank": "",
            },
            header_css: {
                "width" : ``,
                "height" : ``,
                "background-color": ``,
            },
            default_css: {
                "width": ``,
                "height": ``,
                "line-height": ``,
                "color" : ``,
            },
            today_content: {
                "width": ``,
                "height": ``,
                "line-height": ``,
                "color" : "#FFFFFF",
                "background-color": ``,
            }, 
            blank_content: {
                "width": ``,
                "height": ``,
                "background-color": "#E8E8E8",
            }
        }
    },
    methods: {
        checkDays: function (d) {
            let elem = new Date();
            if(this.t == elem.getFullYear() && 
                this.n == elem.getMonth() + 1 && 
                d == elem.getDate()){
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
            for (let e = 0; e < 7; e++) {
                this.weekdays[e] = (this.week[e].substring(0, 3));
            }
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
            this.monthdays = [];
            while (!u) {
                if (this.week[r] == e[0].weekday) {
                    u = true;
                } else {    //補至該月起始星期
                    this.monthdays.push(" ");
                    r++;
                }
            }
            for (let c = 0; c < 42 - r; c++) {
                if (c >= e.length) {    //剩下補空白
                    this.monthdays.push(" ");
                } else {
                    let v = e[c].day;
                    let m = this.isToday(new Date(this.t, this.n - 1, v)) ? '<div class="today">' : "<div>";
                    this.monthdays.push(v);
                }
            }
            this.setStyle();
        },
        getMon: function () {
            this.construct();
            return this.month[`${this.n - 1}`];
        },
        nextMonth: function () {
            this.n++;
            if (this.n > 12) {
                this.n = 1;
                this.t++;
            }
            this.construct();
        },
        prevMonth: function () {
            this.n--;
            if (this.n < 1) {
                this.n = 12;
                this.t--;
            }
            this.construct();
        }
    },
    mounted: function () {

    },
}).mount('#calendar');