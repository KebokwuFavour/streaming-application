<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue'
import axios from 'axios'

const messages = ref([])
const input = ref('')
const scrollBox = ref(null)

onMounted(async () => {
  const { data } = await axios.get('/api/messages')
  messages.value = data

  window.Echo.channel('chat').listen('MessageCreated', (e) => {
    messages.value.push(e.message)
    nextTick(() => scrollBox.value.scrollTop = scrollBox.value.scrollHeight)
  })
})

const send = async () => {
  if (!input.value.trim()) return
  await axios.post('/api/messages', { content: input.value })
  input.value = ''
}
</script>

<template>
    
    <!-- Head element for the title of the page -->
    <Head title="Talks Page" />
    <!-- /Head element for the title of the page -->

    <!-- Navbar -->
    <NavBar />
    <!-- /Navbar -->

    <section class="talks-section">
        <div class="container">
            <div class="p-5">
                <!-- <div class="h-96 overflow-y-auto border rounded mb-4" ref="scrollBox">
                    <div v-for="m in messages" :key="m.id" class="py-1">
                        <strong>{{ m.user.name }}</strong>: {{ m.content }}
                    </div>
                </div>
                <form @submit.prevent="send">
                    <textarea v-model="input" class="form-control border p-2 rounded" placeholder="Type message..."></textarea>
                </form> -->




                <div class="chat-wrapper d-flex h-100">
                    <!-- Sidebar -->
                    <div class="chat-sidebar border-end bg-light" style="width: 300px;">
                        <div class="p-3 border-bottom">
                        <h5>Chats</h5>
                        <!-- search or new chat icon -->
                        </div>
                        <ul class="list-group list-group-flush">
                            <li v-for="contact in contacts" :key="contact.id" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img :src="contact.avatar" class="rounded-circle me-2" width="40" height="40" alt="">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ contact.name }}</div>
                                    <div class="text-muted small">{{ contact.lastMessage }}</div>
                                </div>
                                <span class="badge bg-success rounded-pill">{{ contact.unread }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Chat Panel -->
                    <div class="chat-panel d-flex flex-column flex-grow-1">
                        <!-- Header -->
                        <div class="chat-header p-3 border-bottom d-flex align-items-center">
                            <img :src="activeContact.avatar" class="rounded-circle me-2" width="40" height="40" alt="">
                            <div>
                                <div class="fw-bold">{{ activeContact.name }}</div>
                                <div class="text-muted small">{{ activeContact.status }}</div>
                            </div>
                        </div>

                        <!-- Messages -->
                        <div class="chat-messages p-3 flex-grow-1 overflow-auto" ref="scrollBox">
                            <div v-for="m in messages" :key="m.id"  :class="['d-flex','mb-3', m.user.id === currentUser.id ? 'justify-content-end' : 'justify-content-start']">
                                <div :class="[m.user.id === currentUser.id ? 'bg-primary text-white' : 'bg-light text-dark','p-2 rounded-3','max-w-50']">
                                    <div class="small text-muted">{{ formatTime(m.created_at) }}</div>
                                    <div>{{ m.content }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Input Box -->
                        <div class="chat-input p-3 border-top">
                            <form @submit.prevent="send">
                                <div class="input-group">
                                    <input v-model="input" type="text" class="form-control" placeholder="Type a message" />
                                    <button class="btn btn-success" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- <Footer /> -->
    <!-- /Footer -->
</template>

<style scoped>
.chat-wrapper { height: 100vh; }
/* .chat-sidebar { fixed width, maybe collapsible on mobile } */
.chat-panel { display: flex; flex-direction: column; }
.chat-messages .max-w-50 { max-width: 50%; }
</style>