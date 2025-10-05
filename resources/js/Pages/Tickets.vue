<script setup>
import Footer from "@/Components/Footer.vue";
import NavBar from "@/Components/NavBar.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const email = ref(""); // user email
const amount = ref(5000); // amount in NGN (₦5000 for example)
const isProcessing = ref(false);

// function to handle ticket purchase via paystack
const payWithPaystack = () => {
  isProcessing.value = true;

  let handler = PaystackPop.setup({
    key: "pk_test_xxxxxxxxxxxxxxxx", // Replace with your Paystack public key
    email: email.value,
    amount: amount.value * 100, // Paystack expects amount in Kobo
    currency: "NGN",
    callback: function (response) {
      // send reference to backend for verification
      axios.post("/tickets/verify", {
        reference: response.reference,
      })
      .then((res) => {
        alert("Payment successful! Ticket activated.");
      })
      .catch((err) => {
        console.error(err);
        alert("Payment verification failed.");
      })
      .finally(() => {
        isProcessing.value = false;
      });
    },
    onClose: function () {
        //   isProcessing.value = false;
        //   alert("Transaction was not completed, window closed.");
        
        axios.post("/tickets/verify", {
            reference: "response.reference",
        })
        .then((res) => {
            alert("Transaction Failed! \n\n But for test purposes a 5mins ticket has been activated for you now, confirm the flow and let us discuss further improvements.");

            // // reload the page
            // router.reload();
            // router.push('/streams');
            window.location.href = '/streams';
        })
        .catch((err) => {
            console.error(err);
            alert("Payment verification failed.");
        })
        .finally(() => {
            isProcessing.value = false;
        });
    },
  });

  handler.openIframe();
};
</script>

<template>
    
    <!-- Head element for the title of the page -->
    <Head title="Tickets Page" />
    <!-- /Head element for the title of the page -->

    <!-- Navbar -->
    <NavBar />
    <!-- /Navbar -->

    <!-- Main content -->
    <div class="container my-5" style="min-height: 390px;">
        <div class="row">
            <div class="col-11 col-md-9 mx-auto">
                <div class="card p-4 shadow-lg">
                    <p class="text-center mb-2">
                        You have no ticket yet!
                    </p>
                    <p class="text-center mb-4">
                        Click on the button below to purchaseyour ticket
                    </p>
                    <button type="button" @click="payWithPaystack" :disabled="isProcessing" class="btn btn-sm btn-info w-25 mx-auto">{{ isProcessing ? "Processing..." : "Buy Ticket" }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main content -->

    <!-- Footer -->
    <Footer />
    <!-- /Footer -->

</template>