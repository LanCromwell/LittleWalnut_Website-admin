<!--suppress HtmlUnknownTarget -->
<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="免费天数">
        <el-input v-model="form.remainder_days" placeholder="标题" style="width: 200px;" class="filter-item" />
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
import { getFrontUser, updateFrontUser } from '@/api/front_user';
import router from '@/router';

export default {
  name: 'Add',
  data() {
    return {
      categoryValue: undefined,
      categoryList: [],
      audioUrl: undefined,
      isShowRemindDate: false,
      isShowSort: false,
      languageList: [],
      groupList: [{ name: '每日2分钟提醒', id: 0 }, { name: '五分钟小专题', id: 1 }],
      oneCategoryName: '',
      imageUrl: '',
      oneCategoryList: [],
      form: {
        id: 0,
        remainder_days: 7,
      },
    };
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.getUserInfo(id);
  },
  methods: {
    async getUserInfo(id) {
      const { data } = await getFrontUser(id);
      this.form = data;
      console.log(data);
    },
    handleChange(val) {
      this.form.category_id = val[1];
      console.log(val);
    },

    submitForm() {
      updateFrontUser(this.form).then((response) => {
        this.dialogFormVisible = false;
        if (response.code === 500) {
          this.$notify({
            title: '失败',
            message: '操作失败',
            type: 'fail',
            duration: 2000,
          });
        } else {
          this.$notify({
            title: 'Success',
            message: '成功',
            type: 'success',
            duration: 2000,
          });
        }
        router.push('/front_users/front_users');
      });

      console.log(this.form);
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
