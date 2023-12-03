<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import axios from 'axios';

const events = ref([]);

const getEvent = function (e) {
	let postD = { "year": t.toString(), "month": n.toString() };
	let postdata = JSON.stringify(postD);
	axios.post('https://database--project.000webhostapp.com/get_calendar.php', postdata).then((res) => {
		let ret = res.data;
	});
};
</script>

<template>
	<vue-cal :time="false" hide-view-selector active-view="month"
		hide-weekends events-on-month-view="short" :events="events" style="height: 600px">
	</vue-cal>
</template>

<style scoped>
.vuecal--month-view .vuecal__cell {
	height: 80px;
}

.vuecal--month-view .vuecal__cell-content {
	justify-content: flex-start;
	height: 100%;
	align-items: flex-end;
}

.vuecal--month-view .vuecal__cell-date {
	padding: 4px;
}

.vuecal--month-view .vuecal__no-event {
	display: none;
}
</style>