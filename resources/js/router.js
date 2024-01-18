import { createRouter, createWebHistory } from 'vue-router';

const Login = () => import('./components/auth/Login.vue');
const Register = () => import('./components/auth/Register.vue');
const Random = () => import('./components/quote/RandomQuote.vue');
const Kayne = () => import('./components/quote/KayneQuote.vue');
const Favorites = () => import('./components/user/FavoritesQuotes.vue');
const Profile = () => import('./components/user/Profile.vue');

const routes = [
  {
    name: 'login',
    path: '/',
    component: Login,
  },
  {
    name: 'register',
    path: '/register',
    component: Register,
  },
  {
    name: 'randomQuotes',
    path: '/random/quotes',
    component: Random,
  },
  {
    name: 'KayneQuote',
    path: '/kayne/quote',
    component: Kayne,
  },
  {
    name: 'favorites',
    path: '/favorites/quotes',
    component: Favorites,
  },
  {
    name: 'profile',
    path: '/profile',
    component: Profile,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;