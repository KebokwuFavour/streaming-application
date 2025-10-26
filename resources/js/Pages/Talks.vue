<script setup>
import NavBar from '@/Components/NavBar.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ref, onMounted, nextTick } from 'vue'
import axios from 'axios'

// state
const messages = ref([])
const input = ref('')
const scrollBox = ref(null)
const currentUser = usePage().props.auth.user

// helper: format time (hh:mm)
const formatTime = (ts) => {
  if (!ts) return ''
  const d = new Date(ts)
  return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

onMounted(async () => {
  const { data } = await axios.get('/api/messages')
  messages.value = data
  await nextTick()
  scrollBox.value.scrollTop = scrollBox.value.scrollHeight

  // realtime listener
  window.Echo.channel('chat').listen('MessageCreated', (e) => {
    messages.value.push(e.message)
    nextTick(() => {
      scrollBox.value.scrollTop = scrollBox.value.scrollHeight
    })
  })
})

// send message
const send = async () => {
  if (!input.value.trim()) return
  const content = input.value
  input.value = ''
  try {
    await axios.post('/api/messages', { content })
  } catch (err) {
    console.error('Failed to send message:', err)
  }
}
</script>

<template>
  <Head title="Chat" />
  <NavBar />

  <div class="container-fluid p-0 vh-90 d-flex flex-column">
    <!-- Header -->
    <div class="chat-header border-bottom p-3 bg-white">
      <h5 class="mb-0 text-black">Chat</h5>
    </div>

    <!-- Messages -->
    <div class="chat-messages flex-grow-1 overflow-auto p-3 bg-light" ref="scrollBox">
      <div
        v-for="m in messages"
        :key="m.id"
        :class="['d-flex', 'mb-3', m.user.id === currentUser.id ? 'justify-content-end' : 'justify-content-start']"
      >
        <div
          :class="[m.user.id === currentUser.id ? 'bg-info text-white' : 'bg-white text-dark', 'p-2', 'rounded-3', 'shadow-sm', 'max-w-75']"
        >
          <div class="small text-muted">{{ formatTime(m.created_at) }}</div>
          <div>{{ m.content }}</div>
        </div>
      </div>
    </div>

    <!-- Input -->
    <div class="chat-input border-top p-3 bg-white">
      <form @submit.prevent="send">
        <div class="input-group">
          <input v-model="input" type="text" class="form-control" placeholder="Type a message..." />
          <button class="btn btn-info" type="submit">Send</button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
.vh-90 { height: 90vh; }
.max-w-75 { max-width: 75%; word-break: break-word; }
.chat-messages { background-color: #f8f9fa; }
</style>