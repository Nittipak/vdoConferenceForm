import AdminDashboard from './components/admin/AdminDashboard.vue';
import VideoConferenceRequestsList from './pages/videoconference/VideoConferenceRequestsList.vue';
import UsersList from './pages/users/UserList.vue';

import Profile from './pages/profile/UpdateProfile.vue';

import Home from './components/Dashboard.vue'; //แก้ชื่อไฟล์?
import VideoConferenceForm from './pages/videoconference/VideoConferenceForm.vue';



export default [

    //admin
    {
        path: '/admin//home', //user dashboard 
        name: 'admin.home',
        component: Home,
    },    
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: AdminDashboard,
    },
    {
        path: '/admin/video_conference_requests_list',
        name: 'admin.video_conference_requests_list',
        component: VideoConferenceRequestsList,
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
        component: VideoConferenceForm,
    }
]