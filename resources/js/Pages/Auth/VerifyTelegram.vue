<script setup lang="ts">
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps<{
    status?: string;
}>();

const form = useForm({
    code: ''
});

const submit = () => {
    form.post(route('account.verification.verify'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-code-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Telegram Verification" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, could you verify your account?
        </div>

        <div
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
            v-if="verificationLinkSent"
        >
            A new verification code has been sent.
        </div>

      <form @submit.prevent="submit">
        <div>
          <TextInput
              id="code"
              class="mt-1"
              v-model="form.code"
              required
              autofocus
          />

          <PrimaryButton
              class="ms-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
          >
            Send
          </PrimaryButton>
        </div>
      </form>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <Link
                    :href="route('account.verification.notification')"
                    method="post"
                    as="button"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                  Resend code
                </Link>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                  Log Out
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
