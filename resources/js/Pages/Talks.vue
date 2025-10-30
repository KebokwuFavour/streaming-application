<script setup>
import NavBar from '@/Components/NavBar.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ref, onMounted, nextTick, watch } from 'vue'
import axios from 'axios'

// reactive states
const messages = ref([]) // array to hold chat messages
const input = ref('') // input field model
const scrollBox = ref(null) // reference to messages container for scrolling
const whoIsTyping = ref('') // state to show who is currently typing a message
const currentUser = usePage().props.auth.user // get current authenticated user
const submitBtnText = ref('Send') // submit button text state
const submitBtnDisabled = ref(false) // submit button disabled state


// helper: format time (hh:mm)
const formatTime = (ts) => {
  if (!ts) return '' // handle null or undefined timestamps
  const d = new Date(ts) // create date object
  return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) // format to hh:mm
}


// detect typing and emit event
let typingTimeout
watch(input, (val) => {
  if (!val.trim()) return

  // emit typing event when user types
  axios.post('/api/typing').catch(() => {})

  // clear typing indicator after user stops typing for 2 seconds
  clearTimeout(typingTimeout)
  typingTimeout = setTimeout(() => {
    whoIsTyping.value = ''
  }, 2000)
})


// send message
const send = async () => {
  if (!input.value.trim()) return // prevent sending empty messages
  const content = input.value // get message content
  input.value = '' // clear input field

  submitBtnText.value = 'Sending...' // Change the text of the submit btn to 'Sending...'
  submitBtnDisabled.value = true // Disable the submit btn to prevent multiple clicks

  try {
    await axios.post('/api/messages', { content }) // send message to backend
  } catch (err) {
    console.error('Failed to send message:', err) // log error if sending fails
  }
  // finally {
  //   // submitBtnText.value = 'Send'
  //   // submitBtnDisabled.value = false
  // }
}


// on component mount
onMounted(async () => {
  const { data } = await axios.get('/api/messages') // fetch initial messages
  messages.value = data // load initial messages
  await nextTick() // wait for DOM update
  scrollBox.value.scrollTop = scrollBox.value.scrollHeight // scroll to bottom

  // message broadcast realtime listener
  window.Echo.channel('chat').listen('MessageCreated', (e) => {

    // console.log(e);
    
    // append new message to messages array
    messages.value.push(e.message)

    // when the message appears at the sender screen, enable the submit button and change the text back to 'Send'
    submitBtnText.value = 'Send'
    submitBtnDisabled.value = false

    // scroll to bottom when new message arrives
    nextTick(() => {
      scrollBox.value.scrollTop = scrollBox.value.scrollHeight
    })
  })

  // typing broadcast listener
  window.Echo.channel('typing').listen('TypingMessage', (e) => {
    if (e.user.id !== currentUser.id) {
      whoIsTyping.value = e.user.name + ' is typing...'
      clearTimeout(typingTimeout)
      typingTimeout = setTimeout(() => {
        whoIsTyping.value = ''
      }, 2000)
    }
  })

})

</script>

<template>
  <!-- tab title -->
  <Head title="Community Chat Page" />

  <!-- application navbar -->
  <NavBar />

  <!-- Main Contents - Chat Container -->
  <div class="container-fluid p-0 vh-90 d-flex flex-column">
    <!-- Header -->
    <div class="chat-header border-bottom p-3 bg-white">
      <h5 class="mb-0 text-black">Community Chat</h5>
      <div class="small text-muted">
        <span v-if="whoIsTyping">{{ whoIsTyping }}</span>
      </div>
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
          <div class="small text-muted text-capitalize">{{ m.user.name == currentUser.name ? '' : m.user.name }}</div>
          <div>{{ m.content }}</div>
          <div class="small text-muted text-end">{{ formatTime(m.created_at) }}</div>
        </div>
      </div>
    </div>

    <!-- Input field and submit button -->
    <div class="chat-input border-top p-3 bg-white">
      <form @submit.prevent="send">
        <div class="input-group">
          <input v-model="input" type="text" class="form-control" placeholder="Type a message..." />
          <button type="submit" class="btn btn-info" :disabled="submitBtnDisabled">{{ submitBtnText }}</button>
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