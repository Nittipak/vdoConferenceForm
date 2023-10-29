import AdminDashboard from './components/admin/AdminDashboard.vue';
import FormeRequestsList from './pages/videoconference/FormRequestsList.vue';
import UsersList from './pages/users/UserList.vue';

import Profile from './pages/profile/UpdateProfile.vue';

import Home from './components/Dashboard.vue'; //แก้ชื่อไฟล์?
import Form from './pages/videoconference/Form.vue';



export default [

    //admin
    {
        path: '/admin/home', //user dashboard 
        name: 'admin.home',
        component: Home,
    },    
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: AdminDashboard,
    },
    {
        path: '/admin/forms_list',
        name: 'admin.forms_list',
        component: FormeRequestsList,
    },
    {
        path: '/admin/users_list',
        name: 'admin.users_list',
        component: UsersList,
    },
    {
        path: '/admin/profile',
        name: 'admin.profile',
        component: Profile,
    },
    
    
    
    //user
    
    {
        path: '/home',
        name: 'home',
        component: Home,
    },    
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
    },
    // //แก้ admin->usr
    {
        path: '/admin/video_conference_form',
        name: 'admin.video_conference_form',
        component: Form,
    }
]