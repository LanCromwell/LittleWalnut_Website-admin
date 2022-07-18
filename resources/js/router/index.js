import Vue from 'vue';
import Router from 'vue-router';

/**
 * Layzloading will create many files and slow on compiling, so best not to use lazyloading on devlopment.
 * The syntax is lazyloading, but we convert to proper require() with babel-plugin-syntax-dynamic-import
 * @see https://doc.laravue.dev/guide/advanced/lazy-loading.html
 */

Vue.use(Router);

/* Layout */
import Layout from '@/layout';

/* Router for modules */
// import elementUiRoutes from './modules/element-ui';
// import componentRoutes from './modules/components';
// import chartsRoutes from './modules/charts';
// import tableRoutes from './modules/table';
import adminRoutes from './modules/admin';
// import nestedRoutes from './modules/nested';
import errorRoutes from './modules/error';
// import excelRoutes from './modules/excel';
import permissionRoutes from './modules/permission';

/**
 * Sub-menu only appear when children.length>=1
 * @see https://doc.laravue.dev/guide/essentials/router-and-nav.html
 **/

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirect in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    roles: ['admin', 'editor']   Visible for these roles only
    permissions: ['view menu zip', 'manage user'] Visible for these permissions only
    title: 'title'               the name show in sub-menu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar
    noCache: true                if true, the page will no be cached(default is false)
    breadcrumb: false            if false, the item will hidden in breadcrumb (default is true)
    affix: true                  if true, the tag will affix in the tags-view
  }
**/

export const constantRoutes = [
  {
    path: '/redirect',
    component: Layout,
    hidden: true,
    children: [
      {
        path: '/redirect/:path*',
        component: () => import('@/views/redirect/index'),
      },
    ],
  },
  {
    path: '/login',
    component: () => import('@/views/login/index'),
    hidden: true,
  },
  {
    path: '/auth-redirect',
    component: () => import('@/views/login/AuthRedirect'),
    hidden: true,
  },
  {
    path: '/404',
    redirect: { name: 'Page404' },
    component: () => import('@/views/error-page/404'),
    hidden: true,
  },
  {
    path: '/401',
    component: () => import('@/views/error-page/401'),
    hidden: true,
  },
  {
    path: '',
    component: Layout,
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        component: () => import('@/views/dashboard/index'),
        name: 'Dashboard',
        meta: { title: 'dashboard', icon: 'dashboard', noCache: false },
      },
    ],
  },
  {
    path: '/front_users',
    component: Layout,
    redirect: 'front_users',
    children: [
      {
        path: 'front_users',
        component: () => import('@/views/front_users/index'),
        name: 'front_users',
        meta: { title: 'front_users', icon: 'user', noCache: true },
      },
      {
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/front_users/Edit'),
        name: 'EditFrontUsers',
        meta: { title: '编辑用户信息', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
    ],
  },
  {
    path: '/category',
    component: Layout,
    redirect: 'category/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/category/index'),
        name: 'category',
        meta: { title: 'category', icon: 'list', noCache: true },
      },
      {
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/category/Edit'),
        name: 'EditArticle',
        meta: { title: 'editArticle', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
    ],
  },
  {
    path: '/audio',
    component: Layout,
    redirect: 'audio',
    children: [
      {
        path: 'audio',
        component: () => import('@/views/audio/index'),
        name: 'audio',
        meta: { title: 'audio', icon: 'list', noCache: true },
      },
      {
        path: 'add',
        component: () => import('@/views/audio/Add'),
        name: 'AddAudio',
        meta: { title: 'addAudio', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
      {
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/audio/Edit'),
        name: 'EditAudio',
        meta: { title: 'editAudio', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
    ],
  },
  {
    path: '/channel',
    component: Layout,
    redirect: 'channel',
    children: [
      {
        path: 'channel',
        component: () => import('@/views/channel/index'),
        name: 'channel',
        meta: { title: 'channel', icon: 'list', noCache: true },
      },
      {
        path: 'add',
        component: () => import('@/views/channel/Add'),
        name: 'AddChannel',
        meta: { title: '添加渠道', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
      {
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/channel/Edit'),
        name: 'EditChannel',
        meta: { title: '编辑渠道', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
    ],
  },
  {
    path: '/push_message',
    component: Layout,
    redirect: 'push_message',
    children: [
      {
        path: 'push_message',
        component: () => import('@/views/push_message/index'),
        name: 'push_message',
        meta: { title: 'push_message', icon: 'list', noCache: true },
      },
    ],
  },
  {
    path: '/feedback',
    component: Layout,
    redirect: 'feedback',
    children: [
      {
        path: 'feedback',
        component: () => import('@/views/feedback/index'),
        name: 'feedback',
        meta: { title: 'feedback', icon: 'list', noCache: true },
      },
    ],
  },
  {
    path: '/share',
    component: Layout,
    redirect: 'share/index',
    children: [
      {
        path: 'index',
        component: () => import('@/views/share/index'),
        name: 'share',
        meta: { title: '分享管理', icon: 'list', noCache: true },
      },
    ],
  },
  {
    path: '/date-poster',
    component: Layout,
    redirect: 'date-poster/index',
    children: [
      {
        path: 'date-poster',
        component: () => import('@/views/date-poster/index'),
        name: 'date-poster',
        meta: { title: '日期海报管理', icon: 'list', noCache: true },
      },
      {
        path: 'add',
        component: () => import('@/views/date-poster/Add'),
        name: 'AddDatePoster',
        meta: { title: '添加日期海报', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
      {
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/date-poster/Edit'),
        name: 'EditDatePoster',
        meta: { title: '编辑日期海报', noCache: true, permissions: ['manage article'] },
        hidden: true,
      },
    ],
  },
  {
    path: '/documentation',
    component: Layout,
    redirect: '/documentation/index',
    hidden: true,
    children: [
      {
        path: 'index',
        component: () => import('@/views/documentation/index'),
        name: 'Documentation',
        meta: { title: 'documentation', icon: 'documentation', noCache: true },
      },
    ],
  },
  {
    path: '/guide',
    component: Layout,
    redirect: '/guide/index',
    hidden: true,
    children: [
      {
        path: 'index',
        component: () => import('@/views/guide/index'),
        name: 'Guide',
        meta: { title: 'guide', icon: 'guide', noCache: true },
      },
    ],
  },
  // elementUiRoutes,
];

export const asyncRoutes = [
  permissionRoutes,
  // componentRoutes,
  // chartsRoutes,
  // nestedRoutes,
  // tableRoutes,
  adminRoutes,
  {
    path: '/theme',
    component: Layout,
    redirect: 'noredirect',
    hidden: true,
    children: [
      {
        path: 'index',
        component: () => import('@/views/theme/index'),
        name: 'Theme',
        meta: { title: 'theme', icon: 'theme' },
      },
    ],
  },
  {
    path: '/clipboard',
    component: Layout,
    redirect: 'noredirect',
    meta: { permissions: ['view menu clipboard'] },
    hidden: true,
    children: [
      {
        path: 'index',
        component: () => import('@/views/clipboard/index'),
        name: 'ClipboardDemo',
        meta: { title: 'clipboardDemo', icon: 'clipboard', roles: ['admin', 'manager', 'editor', 'user'] },
      },
    ],
  },
  errorRoutes,
  // excelRoutes,
  {
    path: '/zip',
    component: Layout,
    redirect: '/zip/download',
    alwaysShow: true,
    hidden: true,
    meta: { title: 'zip', icon: 'zip', permissions: ['view menu zip'] },
    children: [
      {
        path: 'download',
        component: () => import('@/views/zip'),
        name: 'ExportZip',
        meta: { title: 'exportZip' },
      },
    ],
  },
  {
    path: '/pdf',
    component: Layout,
    redirect: '/pdf/index',
    meta: { title: 'pdf', icon: 'pdf', permissions: ['view menu pdf'] },
    hidden: true,
    children: [
      {
        path: 'index',
        component: () => import('@/views/pdf'),
        name: 'Pdf',
        meta: { title: 'pdf' },
      },
    ],
  },
  {
    path: '/pdf/download',
    component: () => import('@/views/pdf/Download'),
    hidden: true,
  },
  { path: '*', redirect: '/404', hidden: true },
];

const createRouter = () => new Router({
  // mode: 'history', // require service support
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRoutes,
});

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter();
  router.matcher = newRouter.matcher; // reset router
}

export default router;
