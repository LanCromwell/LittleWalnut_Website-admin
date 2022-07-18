<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="分享图上传">
        <img v-if="imageUrl" width="50%" :src="imageUrl" alt="">
        <el-upload
          action="api/admin/file/upload"
          list-type="picture-card"
          :limit="1"
          :on-preview="handlePictureCardPreview"
          :on-remove="handleRemove"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload"
        >
          <i class="el-icon-plus" />
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
import { getData, updateData } from '@/api/share';
import router from '@/router';

export default {
  name: 'Index',
  data() {
    return {
      dialogVisible: false,
      imageUrl: '',
      form: {
        img: '',
      },
    };
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.getData(id);
  },
  methods: {
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePictureCardPreview(file) {
      this.imageUrl = file.url;
      this.dialogVisible = true;
    },
    handleAvatarSuccess(response, res, file) {
      this.imageUrl = response;
      this.form.img = response;
      console.log(response);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === 'image/jpeg';
      const isPNG = file.type === 'image/png';
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!(isPNG || isJPG)) {
        this.$message.error('上传头像图片只能是 JPG 或者 PNG 格式!');
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 2MB!');
      }
      return isJPG && isLt2M;
    },
    async getData(id) {
      this.listLoading = true;
      const { data } = await getData(id);
      this.form.img = data;
      this.imageUrl = data;

      // Just to simulate the time of the request
      this.listLoading = false;
    },
    submitForm() {
      updateData(this.form).then(() => {
        this.dialogFormVisible = false;
        this.$notify({
          title: 'Success',
          message: 'Updated successfully',
          type: 'success',
          duration: 2000,
        });
      });
      router.push('/share');
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning',
      });
    },
  },
};
</script>

