<!--suppress HtmlUnknownTarget -->
<template>
  <div class="app-container">
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="渠道名称">
        <el-input v-model="form.name" placeholder="标题" style="width: 200px;" class="filter-item" />
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
import { storeChannel, getChannel } from '@/api/channel';
import router from '@/router';

export default {
  name: 'Add',
  data() {
    return {
      form: {
        id: 0,
        name: undefined,
      },
    };
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.getChannelInfo(id);
  },
  methods: {
    async getChannelInfo(id) {
      const { data } = await getChannel(id);
      this.form = data;
    },
    submitForm() {
      this.form.audio_duration = this.duration();
      storeChannel(this.form).then((response) => {
        this.dialogFormVisible = false;
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
        router.push('/channel/channel');
      });
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
