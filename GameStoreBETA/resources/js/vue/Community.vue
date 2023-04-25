<template>
    <div class="w-full mb-5 flex">
        <input
            class="bg-bg-color border-b pb-2 focus:outline-none w-60 ml-auto"
            name="filter-name"
            :placeholder="__('search')"
            v-model="this.filterName"
            @keyup.enter="this.filter"
            type="text"
        />
        <svg
            @click="this.filter"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="w-4 fill-gray-500 relative bottom-1 right-5 hover:cursor-pointer mr-4"
        >
            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path
                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
            />
        </svg>
    </div>
    <ol id="community-list" class="user-list">
        <section
            v-if="this.isFilter"
            v-for="user in this.filteredUsers"
            class=""
        >
            <div class="bg-scnd-color p-4 rounded-md h-32 hover:brightness-105">
                <div class="h-full grid text-black">
                    <a :href="'/user/' + user.name" class="flex">
                        <div class="rounded-full w-24">
                            <img
                                :src="user.profile_photo"
                                alt="Profile Picture"
                                class="rounded-full w-16 h-16"
                            />
                        </div>
                        <div class="mt-1 ml-3 w-full text-left">
                            <p class="text-tx-color">
                                {{ user.name }}
                                <strong
                                    v-if="user.id === this.authid"
                                    class="text-white mt-2"
                                >
                                    ( {{ __("you") }} )</strong
                                >
                            </p>
                            <p class="text-gray-400 text-sm">
                                {{ user.full_name }}
                            </p>
                        </div>
                    </a>

                    <addfriend
                        v-if="authid != user.id"
                        :user="user"
                        :isauth="this.authcheck"
                        :friends="0"
                        :pendingFriendsTo="this.pendingfriendsto"
                        :pendingFriendsFrom="this.pendingfriendsfrom"
                    >
                    </addfriend>

                    <a
                        v-else
                        class="mybutton bg-blue-400 w-32 ml-auto"
                        href="/profile"
                        >{{ __("viewprofile") }}</a
                    >
                </div>
            </div>
        </section>
        <section v-if="!this.isFilter" v-for="user in this.users" class="">
            <div class="bg-scnd-color p-4 rounded-md h-32 hover:brightness-105">
                <div class="h-full grid text-black">
                    <a :href="'/user/' + user.name" class="flex">
                        <div class="rounded-full w-24">
                            <img
                                :src="user.profile_photo"
                                alt="Profile Picture"
                                class="rounded-full w-16 h-16"
                            />
                        </div>
                        <div class="mt-1 ml-3 w-full text-left">
                            <p class="text-tx-color">
                                {{ user.name }}
                                <strong
                                    v-if="user.id === this.authid"
                                    class="text-white mt-2"
                                >
                                    ( {{ __("you") }} )</strong
                                >
                            </p>
                            <p class="text-gray-400 text-sm">
                                {{ user.full_name }}
                            </p>
                        </div>
                    </a>

                    <addfriend
                        v-if="authid != user.id"
                        :user="user"
                        :isauth="this.authcheck"
                        :friends="this.friends"
                        :pendingFriendsTo="this.pendingfriendsto"
                        :pendingFriendsFrom="this.pendingfriendsfrom"
                    >
                    </addfriend>

                    <a
                        v-else
                        class="mybutton bg-blue-400 w-32 ml-auto"
                        href="/profile"
                        >{{ __("viewprofile") }}</a
                    >
                </div>
            </div>
        </section>
    </ol>
</template>

<script>
export default {
    props: [
        "users",
        "authid",
        "friends",
        "pendingfriendsto",
        "pendingfriendsfrom",
        "lang",
    ],
    data() {
        return {
            authcheck: "0",
            filterName: "",
            filteredUsers: [],
            isFilter: false,
            latestFilter: "",
        };
    },
    methods: {
        filter() {
            this.filteredUsers = this.users.filter((e) =>
                e.name.toLowerCase().includes(this.filterName.toLowerCase())
            );
            this.isFilter = true;
            this.latestFilter = this.filterName;
        },
    },
    updated() {
        if (this.filterName == "" && this.isFilter == true) {
            this.isFilter = false;
        }
        if (this.latestFilter !== this.filterName) {
            this.filter();
        }
    },
    created() {
        if (this.authid != null) {
            this.authcheck = "1";
        }
        this.$lang().setLocale(this.lang);
    },
    mounted() {
        axios.get("/getLang").then((response) => {
            this.$lang().setLocale(response.data);
        });
    },
};
</script>

<style></style>
