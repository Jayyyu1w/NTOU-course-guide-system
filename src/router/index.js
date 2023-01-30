import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/all_course',
      name: 'all_course',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AllCourseView.vue')
    },
    {
      path: '/course_info',
      name: 'course_info',
      component: () => import('../views/CourseInfoView.vue'),
    },
    {
      path: '/bulletin',
      name: 'bulletin',
      component: () => import('../views/BulletinView.vue'),
      children: [
        {
          path: 'main',
          name: 'main',
          component: () => import('../components/bulletin.vue')
        },
        {
          path: 'edit',
          name: 'edit',
          component: () => import('../components/bulletin_edit.vue')
        }
      ],
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    { //404Error
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: () => import('../views/NotFoundView.vue')
    }
  ]
})

export default router
