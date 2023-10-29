<script setup>
import axios from 'axios';
import { ref,onMounted,reactive,watch } from 'vue';

const forms = ref([]);

const getForms = () => {
    axios('/api/forms')
    .then((response) => {
        forms.value = response.data;
    })
};

onMounted(() => {
    getForms();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">รายการคำขอ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">รายการคำขอ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between my-5 ">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary">
                                <span class="mr-1">All</span>
                                <span class="badge badge-pill badge-info">1</span>
                            </button>

                            <button type="button" class="btn btn-default">
                                <span class="mr-1">In Process</span>
                                <span class="badge badge-pill badge-primary">0</span>
                            </button>

                            <button type="button" class="btn btn-default">
                                <span class="mr-1">Done</span>
                                <span class="badge badge-pill badge-success">1</span>
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ชื่อ-สกุล</th>
                                        <th scope="col">หัวข้อการประชุม</th>
                                        <th scope="col">ชื่อห้องประชุม</th>
                                        <th scope="col">วันที่ประชุม</th>
                                        <th scope="col">เวลาการประชุม</th>
                                        <th scope="col">สถานะการจัดการ</th>
                                        <!-- <th scope="col">จัดการ</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(form,index) in forms.data" :key="form.id">
                                        <td>{{index + 1}}</td>
                                        <td>{{form.contact_name}}</td>
                                        <td>{{form.meeting_topic}}</td>
                                        <td>{{form.meeting_room_name}}</td>
                                        <td>{{form.meeting_date}}</td>
                                        <td>{{form.meeting_time}}</td>
                                        <td>
                                            <span class="badge" :class="`badge-${form.status.color}`">{{
                                                form.status.name }}</span>
                                        </td>
                                        <!-- <td>
                                            <a href="">
                                                <i class="fa fa-edit mr-2"></i>
                                            </a>

                                            <a href="">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>