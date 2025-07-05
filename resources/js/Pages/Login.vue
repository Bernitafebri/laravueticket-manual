<script>
// import axios from "axios";
import { axios } from "module";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async handleLogin() {
            if (!this.email || !this.password) {
                alert("Email dan password wajib diisi.");
                return;
            }

            try {
                await this.$store.dispatch("login", {
                    email: this.email,
                    password: this.password,
                });
                await this.$router.push("/home");
            } catch (error) {
                const message =
                    error.response?.data?.message ||
                    "Terjadi kesalahan. Coba lagi nanti.";
                alert("Login failed: " + message);
            }
        },
    },
};
</script>

<template>
    <div>
        <h2>Login</h2>
        <form @submit.prevent="handleLogin">
            <input v-model="email" type="email" placeholder="Email" required />
            <input
                v-model="password"
                type="password"
                placeholder="Password"
                required
            />
            <button type="submit">Login</button>
        </form>
    </div>
</template>
