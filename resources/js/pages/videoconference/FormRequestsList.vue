<script setup>
import axios from 'axios';
import { ref,onMounted,reactive,watch,computed } from 'vue';

const formStatus = ref([]);
const selectedStatus = ref();
// const formStatus = {'INPROCESS':1,'DONE':2,'CANCELLED':3};
const getFormStatus = (status) => {
    selectedStatus.value = status;
    axios.get('/api/form-status')
    .then((response)=>{
        formStatus.value = response.data;
    })
};
const forms = ref([]);
const getForms = (status) => {
    const params = {};
    if (status){
        params.status = status;
    }
    axios.get('/api/forms',{
        params: params,
    }).then((response)=>{
        forms.value = response.data;
    })
};

const formsCount = computed(() => {
    return formStatus.value.map(status=>status.count).reduce((acc,value) => acc+value,0)
});

onMounted(() => {
    getForms();
    getFormStatus();
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
                            <button @click="getForms()" type="button" class="btn btn-secondary">
                                <span class="text-bold mr-1">All</span>
                                <span class="badge badge-pill badge-info">{{formsCount}}</span>
                            </button>

                            <button v-for="status in formStatus" @click="getForms(status.value)" type="button" class="btn" :class="[typeof selectedStatus === 'undefined' ? 'btn-secondary' : 'btn-default']">
                                <span class="mr-1 text-bold">{{status.name}}</span>
                                <span class="badge badge-pill" :class="`badge-${status.color}`">{{status.count}}</span>
                            </button>

                            <!-- <button @click="getForms(formStatus.DONE)" type="button" class="btn btn-default">
                                <span class="mr-1">Done</span>
                                <span class="badge badge-pill badge-success">1</span>
                            </button>

                            <button @click="getForms(formStatus.CANCELLED)" type="button" class="btn btn-default">
                                <span class="mr-1">CANCELLED</span>
                                <span class="badge badge-pill badge-danger">1</span>
                            </button> -->
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