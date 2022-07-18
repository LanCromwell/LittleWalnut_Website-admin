<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="选择一级分类">
        <el-select v-model="form.pid" placeholder="请选择一级分类" clearable class="filter-item" style="width: 130px" value="">
          <el-option
            v-for="(item,index) in oneCategoryList"
            :key="item+index"
            :label="item.name"
            :value="item.id"
          />
        </el-select>
      </el-form-item>
      <el-form-item label="二级分类名称">
        <el-input v-model="form.name" />
      </el-form-item>
      <el-form-item label="图标上传">
        <el-upload
          class="avatar-uploader"
          action="api/admin/file/upload"
          :show-file-list="false"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload"
        >
          <img v-if="imageUrl" :src="imageUrl" style="width: 100%; height: 100%" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon" />
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
import { fetchList, fetchCategory, updateData } from '@/api/category';
import router from '@/router';

export default {
  name: 'Edit',
  data() {
    return {
      oneCategoryName: '',
      imageUrl: '',
      oneCategoryList: [],
      form: {
        pid: '',
        id: '',
        name: '',
        img: '',
      },
    };
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.getData(id);
  },
  methods: {
    handleAvatarSuccess(response, res, file) {
      // this.imageUrl = URL.createObjectURL(res.raw);
      this.imageUrl = response;
      this.form.img = response;
      console.log(response);
      // console.log(this.imageUrl);
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
      const { one_category_list } = await fetchList();
      const { data } = await fetchCategory(id);
      this.oneCategoryList = one_category_list;
      this.form = data;
      this.imageUrl = data.img;

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
      router.push('/category');
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

<style scoped>
  .line{
    text-align: center;
  }
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>

