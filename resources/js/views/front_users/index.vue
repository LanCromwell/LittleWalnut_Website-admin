<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="listQuery.phone" placeholder="手机号" style="width: 110px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-input v-model="listQuery.id" placeholder="用户ID" style="width: 100px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
    </div>

    <el-table
      v-loading="listLoading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%;"
    >
      <el-table-column label="ID" align="center" width="60">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.phone')" align="center" width="110">
        <template slot-scope="scope">
          <span>{{ scope.row.phone }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.role_name')" prop="role_name" align="center" width="100">
        <template slot-scope="scope">
          <span>{{ scope.row.role_name }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.language_name')" prop="language_name" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.language_name }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.child_birthday')" prop="child_birthday" align="center" width="100">
        <template slot-scope="scope">
          <span>{{ scope.row.child_birthday }}</span>
        </template>
      </el-table-column>
      <el-table-column label="vip" prop="is_receive_vip" align="center" width="50">
        <template slot-scope="scope">
          <span>{{ scope.row.is_receive_vip }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.detailed_location')" prop="detailed_location" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.detailed_location }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.invitation_code')" prop="invitation_code" align="center" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.invitation_code }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.phone_model')" prop="phone_model" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.phone_model }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.operator')" prop="operator" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.operator }}</span>
        </template>
      </el-table-column>
      <el-table-column label="音频搜索记录" prop="search_list" align="center" width="120">
        <template slot-scope="scope">
          <el-popover placement="top-start" prop="search_list" width="250" trigger="hover">
            <div>{{ scope.row.search_list }}</div>
            <span slot="reference">{{ scope.row.search_list.substr(0,30)+'...' }}</span>
          </el-popover>
        </template>
      </el-table-column>
      <el-table-column label="音频收听记录" prop="listen_list" align="center" width="120">
        <template slot-scope="scope">
          <el-popover placement="top-start" prop="listen_list" width="250" trigger="hover">
            <div>{{ scope.row.listen_list }}</div>
            <span slot="reference">{{ scope.row.listen_list.substr(0,30)+'...' }}</span>
          </el-popover>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.collection_list')" prop="collection_list" align="center" width="120">
        <template slot-scope="scope">
          <el-popover placement="top-start" prop="collection_list" width="250" trigger="hover">
            <div>{{ scope.row.collection_list }}</div>
            <span slot="reference">{{ scope.row.collection_list.substr(0,30)+'...' }}</span>
          </el-popover>
        </template>
      </el-table-column>
      <el-table-column label="注册时间" prop="add_time" align="center" width="100">
        <template slot-scope="scope">
          <span>{{ scope.row.add_time }}</span>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.actions')" align="center" width="300" class-name="small-padding fixed-width">
        <template slot-scope="{row}">
          <router-link :to="{path: '/front_users/front_users', query: {user_id: row.id }}">
            <el-button type="primary" size="small">
              查看邀请列表
            </el-button>
          </router-link>
          <router-link :to="'/front_users/edit/' + row.id">
            <el-button type="primary" size="small">
              编辑
            </el-button>
          </router-link>
          <el-button type="primary" size="small" @click="handleUpdate(row)">
            修改密码
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="fetchData" />

    <el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible">
      <el-form :model="temp" label-position="left" label-width="70px" style="width: 400px; margin-left:50px;">
        <el-form-item label="密码">
          <el-input v-model="temp.password" type="password" />
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
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import { fetchList, updateFrontUserPwd } from '@/api/front_user';
import waves from '@/directive/waves';

export default {
  name: 'UserList',
  components: { Pagination },
  directives: { waves },

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
        password: '',
      },
      total: 0,
      listLoading: true,
      list: null,
      listQuery: {
        page: 1,
        limit: 10,
        importance: undefined,
        phone: undefined,
        id: undefined,
        type: undefined,
        sort: '+id',
      },
      downloadLoading: false,
      filename: '',
    };
  },
  created() {
    this.listQuery.user_id = this.$route.query.user_id;
    this.listQuery.invitation_code = this.$route.query.invitation_code;
    this.fetchData();
  },
  methods: {
    handleUpdate(row) {
      this.temp = Object.assign({}, row); // copy obj
      this.dialogStatus = 'update';
      this.dialogFormVisible = true;
    },
    updateData() {
      var data = this.temp;
      updateFrontUserPwd(data).then((response) => {
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
    async fetchData() {
      this.listLoading = true;
      const { data, meta } = await fetchList(this.listQuery);
      this.list = data;
      this.total = meta.total;
      this.listLoading = false;
    },
    handleFilter() {
      this.listQuery.page = 1;
      this.fetchData();
    },
  },
};
</script>
