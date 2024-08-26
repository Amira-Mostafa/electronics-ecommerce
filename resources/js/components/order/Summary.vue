<template>
    <div class="checkout">
        <div class="row d-flex flex-row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
                    <h4 class="text-muted small" v-text="'Transaction_ID :' + order.transaction_id"></h4>
                    <h2 class="text-muted">thanks for purchase</h2>
                    <table class="table">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in order.products" :key="item.id">
                                <td class="p-4" v-text="item.name"></td>
                                <td class="p-4" v-text="item.pivot.quantity"></td>
                                <td class="p-4" v-text="cartLineTotal(item)"></td>
                            </tr>
                            <tr>
                                <td class="p-4 fw-bold">Total Amount</td>
                                <td class="p-4 fw-bold" v-text="orderQuantity"></td>
                                <td class="p-4 fw-bold" v-text="orderTotal"></td>
                                <td class="w-10 text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        cartLineTotal(item) {
            let amount = item.price * item.quantity;
            amount = (amount / 100);
            return amount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        },
    },
    computed: {
        order() {
            return this.$store.state.cart;
        },
        orderQuantity() {
            return this.$store.state.order.products.reduce((acc, item) => acc + Number(item.pivot.quantity, 0));
        },
        orderTotal() {
            let amount = this.$store.state.order.products
                .reduce((acc, item) => acc + Number(item.pivot.quantity, 0))
            amount = (amount / 100);
            return amount.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        },
    }
}
</script>