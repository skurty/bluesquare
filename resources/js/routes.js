import Home from './components/home/HomeComponent.vue'
import ProjectList from './components/project/ProjectListComponent.vue'
import TicketList from './components/ticket/TicketListComponent.vue'
import TicketDetails from './components/ticket/TicketDetailsComponent.vue'
import TicketUpdate from './components/ticket/TicketUpdateComponent.vue'

export const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/projects',
        name: 'ProjectList',
        component: ProjectList
    },
    {
        path: '/projects/:projectId/tickets',
        name: 'TicketList',
        component: TicketList
    },
    {
        path: '/projects/:projectId/tickets/:ticketId',
        name: 'TicketDetails',
        component: TicketDetails,
        props: true,
    },
    {
        path: '/projects/:projectId/tickets/:ticketId/update',
        name: 'TicketUpdate',
        component: TicketUpdate,
        props: true,
    },
];
