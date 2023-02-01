import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import AllCourseView from '@/views/AllCourseView.vue'
import BulletinView from '@/views/BulletinView.vue'
import LoginView from '@/views/LoginView.vue'
import NotFoundView from '@/views/NotFoundView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView
    },
    {
      path: '/course',
      name: 'Course',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: AllCourseView,
      children: [
        {
          path: 'all',
          name: 'All',
          component: () => import('../components/all_course.vue')
        },
        {
          path: 'info/:id',
          name: 'Info',
          component: () => import('../components/course_detail.vue'),
        },
        {
          path: 'info/:id/edit',
          name: 'InfoEdit',
          component: () => import('../components/course_edit.vue')
        }
      ]
    },
    {
      path: '/bulletin',
      name: 'Bulletin',
      component: BulletinView,
      children: [
        {
          path: 'main',
          name: 'Main',
          component: () => import('../components/bulletin.vue')
        },
        {
          path: 'edit',
          name: 'BulletinEdit',
          component: () => import('../components/bulletin_edit.vue')
        }
      ],
    },
    {
      path: '/login',
      name: 'Login',
      component: LoginView,
    },
    { //404Error
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NotFoundView,
    }
  ]
})

export default router
