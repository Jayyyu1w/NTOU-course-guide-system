<script setup>
import navbars from '../components/head.vue'
import all_course from '../components/all_course.vue'
</script>

<template>
  <navbars />
  <div id="fixpos"></div>
  <section id="all_course">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="offset-md-1 col-md-10">
              <div class="container mb-5">
                <all_course />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style>
</style>
