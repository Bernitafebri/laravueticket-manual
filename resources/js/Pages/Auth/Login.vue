<template>
    <div class="flex justify-center items-center h-screen">
        <div class="w-1/2 h-screen hidden lg:block">
            <img
                src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826"
                alt="Placeholder Image"
                class="object-cover w-full h-full"
            />
        </div>
        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <h1 class="text-2xl font-semibold mb-4">Login</h1>
            <form @submit.prevent="handleLogin">
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email</label>
                    <input
                        type="text"
                        id="email"
                        v-model="email"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off"
                    />
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-800"
                        >Password</label
                    >
                    <input
                        type="password"
                        id="password"
                        v-model="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                        autocomplete="off"
                    />
                </div>
                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async handleLogin() {
            try {
                const response = await axios.post("/api/login", {
                    email: this.email,
                    password: this.password,
                });

                // Simpan token atau lakukan redirect sesuai kebutuhan
                console.log("Login success:", response.data);

                // Misal redirect ke dashboard
                this.$router.push("/home");
            } catch (error) {
                console.error(
                    "Login error:",
                    error.response?.data || error.message
                );
                alert(
                    "Login gagal: " +
                        (error.response?.data?.message || "Terjadi kesalahan.")
                );
            }
        },
    },
};
</script>
