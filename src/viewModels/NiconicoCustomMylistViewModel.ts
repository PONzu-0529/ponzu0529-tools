import { Component } from 'vue-property-decorator'

// Model
import { VocaloidMusicApiModel } from '@/models/apis/VocaloidMusicApiModel'
import { VocaloidMusicModel } from '@/models/VocaloidMusicModel'

// ViewModel
import Base from '@/viewModels/Base'


@Component({})
export default class NiconicoCustomMylistViewModel extends Base {
  private musicList: Array<VocaloidMusicModel> = [];

  private vocaloidMusicApiModel: VocaloidMusicApiModel;


  constructor() {
    super()
    this.vocaloidMusicApiModel = new VocaloidMusicApiModel()
  }


  public getMusicList(): Array<VocaloidMusicModel> {
    return this.musicList
  }


  public async setMusicList(): Promise<void> {
    const callApiResult = await this.vocaloidMusicApiModel.getMusicList()

    if (callApiResult.status !== 'success') {
      console.error(callApiResult.data)
      this.musicList = []
    } else {
      this.musicList = callApiResult.data
    }
  }
}
