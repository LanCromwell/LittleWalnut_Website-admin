<template>
  <div class="app-container">
    <el-table
      :key="tableKey"
      v-loading="listLoading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%;"
    >
      <el-table-column :label="$t('table.id')" prop="id" align="center" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.title')" prop="title" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.title }}</span>
        </template>
      </el-table-column>
      <el-table-column label="内容" prop="content" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.content }}</span>
        </template>
      </el-table-column>
      <el-table-column label="推送时间" width="150px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.push_time }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.add_time')" width="150px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.add_time | parseTime('{y}-{m}-{d} {h}:{i}') }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.actions')" align="center" width="230" class-name="small-padding fixed-width">
        <template slot-scope="{row}">
          <el-button type="primary" size="mini" @click="handleUpdate(row)">
            {{ $t('table.edit') }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible">
      <el-form :model="temp" label-position="left" label-width="70px" style="width: 400px; margin-left:50px;">
        <el-form-item label="标题" prop="title">
          <el-input v-model="temp.title" />
        </el-form-item>
        <el-form-item label="内容">
          <el-input v-model="temp.content" />
        </el-form-item>
        <el-form-item label="推送时间" prop="push_time">
          <el-time-select
            v-model="temp.push_time"
            :picker-options="{
              start: '08:30',
              step: '00:01',
              end: '18:30'
            }"
            placeholder="选择时间"
          />
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">
          {{ $t('table.cancel') }}
        </el-button>
        <el-button type="primary" @click="updateData()">
          {{ $t('table.confirm') }}
        </el-button>
      </div>
    </el-dialog>

  </div>

</template>

<script>
import { fetchList, updatePushMsg } from '@/api/push_message';

export default {
  name: 'Index',
  data() {
    return {
      dialogStatus: '',
      dialogFormVisible: false,
      textMap: {
        update: 'Edit',
        create: 'Create',
      },
      temp: {
        id: 0,
        title: '',
        content: '',
        push_time: '',
      },
      tableKey: 0,
      list: null,
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
        importance: undefined,
        title: undefined,
        type: undefined,
        sort: '+id',
      },
      downloadLoading: false,
    };
  },
  created() {
    this.getList();
  },
  methods: {
    updateData() {
      var data = this.temp;
      updatePushMsg(data).then((response) => {
        for (const v of this.list) {
          if (v.id === this.temp.id) {
            const index = this.list.indexOf(v);
            this.list.splice(index, 1, this.temp);
            break;
          }
        }
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
      });
    },

    handleUpdate(row) {
      this.temp = Object.assign({}, row); // copy obj
      this.dialogStatus = 'update';
      this.dialogFormVisible = true;
    },
    async getList() {
      this.listLoading = true;
      const { data } = await fetchList(this.listQuery);
      this.list = data;

      // Just to simulate the time of the request
      this.listLoading = false;
    },
  },
};
</script>
