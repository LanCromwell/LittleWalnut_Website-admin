<!--suppress HtmlUnknownTarget -->
<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="日期">
        <el-date-picker
          v-model="form.date"
          type="date"
          placeholder="选择日期"
          format="yyyy-MM-dd"
          value-format="yyyy-MM-dd"
        />
      </el-form-item>
      <el-form-item label="备注">
        <el-input v-model="form.remark" placeholder="备注" style="width: 200px;" class="filter-item" />
      </el-form-item>
      <el-form-item label="海报上传">
        <el-image
          v-if="form.path"
          style="width: 100px; height: 100px"
          :src="form.path"
        />
        <el-upload
          class="upload-demo"
          drag
          :limit="1"
          action="api/admin/file/upload"
          :on-success="handlePosterSuccess"
          :data="extraData"
          accept="image/png, image/jpeg"
          multiple
        >
          <i
            class="el-icon-upload"
          />
          <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
          <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
        </el-upload>
      </el-form-item>
      <el-button
        style="margin-left: 10px;"
        type="primary"
        @click="submitForm"
      >
        提交
      </el-button>
    </el-form>
  </div>
</template>

<script>
import { insertData, getAudioInfo } from '@/api/date-poster';
import router from '@/router';

export default {
  name: 'Add',
  data() {
    return {
      extraData: {
        type: 'date_poster',
      },
      form: {
        id: 0,
        path: '',
        remark: '',
        date: '',
      },
    };
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.form.id = id;
    this.getAudioInfo(id);
  },
  methods: {
    handlePosterSuccess(response, res, file) {
      this.form.path = response;
      console.log(response);
    },
    // beforePosterUpload(file) {
    //   const isJPG = file.type === 'image/jpeg';
    //   const isPNG = file.type === 'image/png';
    //   const isLt2M = file.size / 1024 / 1024 < 2;
    //
    //   if (!(isPNG || isJPG)) {
    //     this.$message.error('上传头像图片只能是 JPG 或者 PNG 格式!');
    //   }
    //   if (!isLt2M) {
    //     this.$message.error('上传头像图片大小不能超过 2MB!');
    //   }
    //   return isJPG && isLt2M;
    // },
    async getAudioInfo(id) {
      const { data } = await getAudioInfo(id);
      this.form = data;
      console.log(data);
    },
    submitForm() {
      insertData(this.form).then((response) => {
        this.dialogFormVisible = false;
        console.log(response);
        if (response.code === 200) {
          this.$notify({
            title: 'Success',
            message: '成功',
            type: 'success',
            duration: 2000,
          });
        } else {
          this.$notify({
            title: '失败',
            message: '操作失败',
            type: 'fail',
            duration: 2000,
          });
        }
        router.push('/date-poster/date-poster');
      });
    },
  },
};
</script>
