
import Show from "./components/product/Show.vue";
import Summary from "./components/order/Summary.vue";
import Index from "./components/product/Index.vue";
import Checkout from "./components/order/Checkout.vue";


export const routes = [
    {
        path: '/',
        name: 'product.index',
        component: Index,
    },
    {
        path: '/product/:slug',
        name: 'product.show',
        component: Show,
    },
    {
        path: '/checkout',
        name: 'order.checkout',
        component: Checkout,
    },
    {
        path: '/summary',
        name: 'order.summary',
        component: Summary,
    },
]