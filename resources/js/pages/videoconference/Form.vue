<script setup>
import axios from 'axios';
import { ref,onMounted,reactive, computed } from 'vue';
import { Form,Field } from 'vee-validate';
import * as yup from 'yup';
import institutions from '../../dropdown.json';
import { useRouter, useRoute } from 'vue-router';
import { useToastr } from '@/toastr';

const router = useRouter();
const route = useRoute();
const toastr = useToastr();

const editing = ref(false);
// const formValues = ref();

const users = ref();
const getUsers = () => {
    axios.get('/api/users')
    .then((response) => {
        users.value = response.data;
    })
};

const form = reactive({
    user_id:"1",
    meeting_date: '',
    meeting_time: '',
    meeting_topic: '',
    meeting_room_name: '',
    //assets
    notebook: '',
    speaker: '',
    
    //contact
    contact_email: '',
    contact_name: '',
    contact_number:'',
    institution: '',
    เลขที่หนังสือ: '',
});

const createForm = (values, actions) => {
    axios.post('/api/forms/create', form)
    .then((response) => {
        router.push('/admin/forms_list');
        toastr.success('Form created successfully!');
    })
    .catch((error) => {
        actions.setErrors(error.response.data.errors);
    })
};

onMounted(() => {
    getUsers();
});

</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-bold">ฟอร์ม</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- home == calendar page -->
                        <li class="breadcrumb-item"><a href="#">Home</a></li> 
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 mx-4 bg-white space-y-6 sm:p-6 shadow sm:rounded-md sm:overflow-hidden" id="vdoconferencerequestform">
        <Form @submit="createForm" v-slot:default="{ errors }">
            <!-- Request Form feilds -->
            <div class="modal-body">
            <div class="px-4 py-5 bg-gray-200 space-y-6 sm:p-6">
                <!-- //กำหนดไม่ให้เลือกย้อนหลัง -->
                <!-- meeting Date -->
                <!-- <div v-model="form.">
                  <label for="user_name">{{form.}}</label>
                </div> -->
                <div class="form-group">
                  <label for="meeting_date">กำหนดวันประชุม</label>
                  <input
                    required
                    type="date"
                    class="form-control"
                    name="meeting_date"
                    v-model="form.meeting_date"
                    id="meeting_date"/>
                </div>
                <!--/ meeting Date -->
            
                <!-- <meeting_time> -->
                <div class="form-group">
                  <label for="meeting_topic" 
                    >กำหนดเวลาการประชุม
                  </label>
                  <input
                    required
                    type="time"
                    name="meeting_time"
                    id="meeting_time"
                    v-model="form.meeting_time"
                    class="form-control"
                  />
                </div>
                <!-- </meeting_time> -->
            
                <!-- topic -->
                <div class="form-group">
                  <label for="meeting_topic"
                    >หัวข้อการประชุม
                  </label>
                  <input
                    required
                    type="text"
                    name="meeting_topic"
                    id="meeting_topic"
                    v-model="form.meeting_topic"
                    class="form-control"
                  />
                </div>
                <!--/ topic -->
                
                <!-- meeting_room_name -->
                <div class="form-group">
                  <label for="meeting_room_name" >
                    ชื่อห้องประชุม
                  </label>
                  <div class="mt-1">
                    <input
                      required
                      type="text"
                      name="meeting_room_name"
                      id="meeting_room_name"
                      v-model="form.meeting_room_name"
                      class="form-control"
                    />
                  </div>
                </div>
                <!-- meeting_room_name -->
            
                <!-- notebook and speaker-->
                <div class="form-group">
                  <label>อุปกรณ์ที่ต้องการติดตั้ง
                  </label>
                  <div class="flex">
                    <input
                      id="notebook"
                      name="notebook"
                      type="checkbox"
                      true-value="ต้องการ"
                      false-value="ไม่ต้องการ" 
                      v-model="form.notebook"
                      class="shadow-sm h-4 w-4 focus:ring-indigo-500 text-indigo-600 border border-gray-300 rounded"
                    />
                    <p for="notebook"
                      >Notebook</p
                    >
                    <input
                      for="speaker"
                      id="speaker"
                      name="speaker"
                      type="checkbox"
                      true-value="ต้องการ"
                      false-value="ไม่ต้องการ" 
                      v-model="form.speaker"
                      class="shadow-sm h-4 w-4 focus:ring-indigo-500 text-indigo-600 border border-gray-300 rounded"
                    />
                    <p for="speaker"
                      >Speaker</p>
                    <!--/ notebook and speaker-->
                  </div>
                </div>
                <!-- <contact_email> -->
                <div class="form-group">
                  <label for="contact_email" 
                    >e-mail ผู้ประสานงาน
                  </label>
                  <input
                    type="email"
                    pattern=".+@bb.go.th"
                    required
                    name="contact_email"
                    id="contact_email"
                    v-model="form.contact_email"
                    placeholder="example@bb.go.th"
                    class="form-control"
                  />
                </div>
                <!-- </contact_email> -->
                
                
                <!-- dropdown institution -->
                <div class="form-group">
                  <label for="institution">สำนักงาน/กอง/ศูนย์/สถาบัน/กลุ่ม</label>
                    <div class="input-group mb-3">
                      <select required v-model="form.institution" class="custom-select" id="institution">
                        <option v-for="institution in institutions" :value="institution" >{{ institution }}</option>
                      </select>
                    </div>
                  </div>
                <!--/ dropdown institution -->
              
                <!-- <contact_name> -->
                <div class="form-group">
                  <label for="contact_name" 
                    >ชื่อ-สกุล ผู้ประสานงานที่ติดต่อได้
                  </label>
                  <input
                    required
                    type="text"
                    name="contact_name"
                    id="contact_name"
                    v-model="form.contact_name"
                    class="form-control"
                  />
                </div>
                <!-- </contact_name> -->
            
                <!-- <contact_number> -->
                <div class="form-group">
                  <label for="contact_number" >เบอร์โทรศัพท์ที่ติดต่อได้
                  </label>
                  <input
                    type="number"
                    name="contact_number"
                    id="contact_number"
                    v-model="form.contact_number"
                    class="form-control"
                  />
                </div>
                <!-- </contact_name> -->
            
            
                <!-- <เลขที่หนังสือ> -->
                <div class="form-group">
                  <label for="เลขที่หนังสือ" 
                    >เลขที่หนังสือขอใช้ Conference (ถ้ามี)
                  </label>
                  <input
                    type="text"
                    name="เลขที่หนังสือ"
                    id="เลขที่หนังสือ"
                    v-model="form.เลขที่หนังสือ"
                    placeholder=" นร 07/xx.x/xxx/xxxx"
                    class="form-control"
                  />
                </div>
                <!-- </เลขที่หนังสือ> -->
              </div>
              <!--/ Request Fields -->


            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
      </Form>
    </div>
</template>